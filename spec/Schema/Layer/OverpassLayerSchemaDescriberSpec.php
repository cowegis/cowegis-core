<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema\Layer;

use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use function expect;

final class OverpassLayerSchemaDescriberSpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beConstructedWith('overpass');
    }

    public function it_describes_the_overpass_layer_variant(Info $info, Schema $idSchema, Schema $objectId): void
    {
        $idSchema->objectId(Argument::any())->willReturn($objectId->getWrappedObject());
        $idSchema->toArray()->willReturn(['type' => 'string']);
        $objectId->toArray()->willReturn(['type' => 'string']);

        $builder = SchemaBuilder::create($info->getWrappedObject(), $idSchema->getWrappedObject());
        $array   = $this->describe($builder)->getWrappedObject()->toArray();

        expect($array)->shouldHaveKey('allOf');
        expect($array['allOf'][1]['properties'])->shouldHaveKey('query');
        expect($array['allOf'][1]['properties'])->shouldHaveKey('endpoint');
        expect($array['allOf'][1]['properties'])->shouldHaveKey('minZoom');
    }
}
