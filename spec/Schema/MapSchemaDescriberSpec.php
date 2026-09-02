<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema;

use Cowegis\Core\Schema\Control\ZoomControlSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use function expect;

final class MapSchemaDescriberSpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beConstructedWith([], [new ZoomControlSchemaDescriber('zoom')]);
    }

    public function it_registers_the_control_base_and_a_non_empty_controls_oneof(
        Info $info,
        Schema $idSchema,
        Schema $objectId,
    ): void {
        $info->toArray()->willReturn(['title' => 'Test API', 'version' => '1.0.0']);
        $idSchema->objectId(Argument::any())->willReturn($objectId->getWrappedObject());
        $idSchema->toArray()->willReturn(['type' => 'string']);
        $objectId->toArray()->willReturn(['type' => 'string']);

        $builder = SchemaBuilder::create($info->getWrappedObject(), $idSchema->getWrappedObject());
        $this->describe($builder);

        $doc = $builder->build()->toArray();

        expect($doc['components']['schemas'])->shouldHaveKey('ControlType');

        $controls = $doc['components']['schemas']['MapSchema']['properties']['controls'];
        expect($controls['type'])->toBe('array');
        expect($controls['items'])->shouldHaveKey('oneOf');
        expect($controls['items']['oneOf'])->shouldHaveCount(1);
    }
}
