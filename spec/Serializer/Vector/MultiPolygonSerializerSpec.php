<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Vector\MultiPolygon;
use Cowegis\Core\Serializer\Serializer;
use Cowegis\Core\Serializer\Vector\MultiPolygonSerializer;
use PhpSpec\ObjectBehavior;

final class MultiPolygonSerializerSpec extends ObjectBehavior
{
    public function let(Serializer $serializer): void
    {
        $this->beConstructedWith($serializer);
    }

    public function it_is_initializable(): void
    {
        $this->shouldBeAnInstanceOf(MultiPolygonSerializer::class);
    }

    public function it_serializes_multi_polygon(DefinitionId $definitionId): void
    {
        $multiPolygon = new MultiPolygon(
            new LayerId($definitionId->getWrappedObject()),
            'example',
            [
                [
                    new LatLngList([new LatLng(0.0, 0.0), new LatLng(1.0, 1.0)]),
                    new LatLngList([new LatLng(2.0, 2.0)]),
                ],
                [
                    new LatLngList([new LatLng(3.0, 2.0)]),
                    new LatLngList([new LatLng(4.0, 2.0)]),
                ],
            ],
            true
        );

        $definitionId->value()->willReturn('example_1');

        $this->serialize($multiPolygon)->shouldReturn(
            [
                'layerId'        => 'example_1',
                'name'           => 'example',
                'title'          => 'example',
                'initialVisible' => true,
                'options'        => null,
                'events'         => null,
                'type'           => 'multiPolygon',
                'latlngs'        => [
                    [
                        [
                            [0.0, 0.0],
                            [1.0, 1.0],
                        ],
                        [
                            [2.0, 2.0],
                        ],
                    ],
                    [
                        [
                            [3.0, 2.0],
                        ],
                        [
                            [4.0, 2.0],
                        ],
                    ],
                ],
            ]
        );
    }
}
