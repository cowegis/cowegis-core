<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema;

use Cowegis\Core\Schema\ComponentsBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use PhpSpec\ObjectBehavior;

final class ComponentsBuilderSpec extends ObjectBehavior
{
    public function it_is_initializable() : void
    {
        $this->shouldHaveType(ComponentsBuilder::class);
    }

    public function it_add_schemas() : void
    {
        $schemaA = Schema::create('foo');
        $schemaB = Schema::create('bar');

        $this->withSchema($schemaA)->ref->shouldBe('#/components/schemas/foo');
        $this->withSchema($schemaB)->ref->shouldBe('#/components/schemas/bar');

        $this->build()->schemas->shouldReturn([$schemaA, $schemaB]);
    }

    public function it_creates_unique_schema_reference() : void
    {
        $schemaA = Schema::create('foo');
        $schemaB = Schema::create('foo');
        $schemaC = Schema::create('foo');

        $this->withSchema($schemaA)->ref->shouldBe('#/components/schemas/foo');
        $this->withSchema($schemaB)->ref->shouldBe('#/components/schemas/foo2');

        $ref = $this->withSchema($schemaC, 'bar');
        $ref->ref->shouldBe('#/components/schemas/bar');

        $this->build()->schemas->shouldReturn([$schemaA, $schemaB, $schemaC]);
    }
}
