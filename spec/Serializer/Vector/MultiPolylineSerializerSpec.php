<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Vector\MultiPolyline;
use Cowegis\Core\Serializer\Serializer;
use Cowegis\Core\Serializer\Vector\MultiPolylineSerializer;
use PhpSpec\ObjectBehavior;

final class MultiPolylineSerializerSpec extends ObjectBehavior
{
    public function let(Serializer $serializer): void
    {
        $this->beConstructedWith($serializer);
    }

    public function it_is_initializable(): void
    {
        $this->shouldBeAnInstanceOf(MultiPolylineSerializer::class);
    }

    public function it_serializes_multi_polyline(DefinitionId $definitionId): void
    {
        $multiPolyline = new MultiPolyline(
            new LayerId($definitionId->getWrappedObject()),
            'example',
            [
                new LatLngList([new LatLng(0.0, 0.0), new LatLng(1.0, 1.0)]),
                new LatLngList([new LatLng(2.0, 2.0)]),
            ],
            true
        );

        $definitionId->value()->willReturn('example_1');

        $this->serialize($multiPolyline)->shouldReturn(
            [
                'layerId'        => 'example_1',
                'name'           => 'example',
                'title'          => 'example',
                'initialVisible' => true,
                'options'        => null,
                'events'         => null,
                'type'           => 'multiPolyline',
                'latlngs'        => [
                    [
                        [0.0, 0.0],
                        [1.0, 1.0],
                    ],
                    [
                        [2.0, 2.0],
                    ],
                ],
            ]
        );
    }
}
