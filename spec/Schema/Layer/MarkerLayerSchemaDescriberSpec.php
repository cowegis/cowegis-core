<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema\Layer;

use Cowegis\Core\Schema\Layer\MarkerLayerSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use function expect;

final class MarkerLayerSchemaDescriberSpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beConstructedWith('markers');
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(MarkerLayerSchemaDescriber::class);
    }

    public function it_describes_an_enveloped_marker_data_path(Info $info, Schema $idSchema, Schema $objectId): void
    {
        $info->toArray()->willReturn(['title' => 'Test API', 'version' => '1.0.0']);
        $idSchema->objectId(Argument::any())->willReturn($objectId->getWrappedObject());
        $idSchema->toArray()->willReturn(['type' => 'string']);
        $objectId->toArray()->willReturn(['type' => 'string']);

        $builder = SchemaBuilder::create($info->getWrappedObject(), $idSchema->getWrappedObject());
        $this->describe($builder);

        $doc  = $builder->build()->toArray();
        $path = $doc['paths']['/map/{mapId}/markers/{layerId}']['get'];

        expect($path['responses'])->shouldHaveKey(200);
        expect($path['responses'])->shouldHaveKey(404);
        expect($doc['components']['schemas'])->shouldHaveKey('MarkerDataResponse');
        expect($doc['components']['schemas']['MarkerDataResponse']['properties'])->shouldHaveKey('data');
        expect($doc['components']['schemas']['MarkerDataResponse']['properties'])->shouldHaveKey('assets');
    }
}
