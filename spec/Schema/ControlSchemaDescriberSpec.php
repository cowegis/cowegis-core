<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema;

use Cowegis\Core\Schema\ControlSchema;
use Cowegis\Core\Schema\ControlSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use function expect;

final class ControlSchemaDescriberSpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beAnInstanceOf(TestControlSchemaDescriber::class);
        $this->beConstructedWith('zoom');
    }

    public function it_builds_an_allof_named_after_the_control_type(
        Info $info,
        Schema $idSchema,
        Schema $objectId,
    ): void {
        $idSchema->objectId(Argument::any())->willReturn($objectId->getWrappedObject());
        $idSchema->toArray()->willReturn(['type' => 'string']);
        $objectId->toArray()->willReturn(['type' => 'string']);

        $builder = SchemaBuilder::create($info->getWrappedObject(), $idSchema->getWrappedObject());
        $result  = $this->describe($builder);

        $array = $result->getWrappedObject()->toArray();

        expect($array)->shouldHaveKey('allOf');
        expect($array['allOf'][0])->shouldHaveKey('$ref');
        expect($array['allOf'][0]['$ref'])->toBe(ControlSchema::FULL_REF);
    }
}

// phpcs:ignore
final class TestControlSchemaDescriber extends ControlSchemaDescriber
{
}
