<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Vector\CircleMarker;
use Cowegis\Core\Serializer\Serializer;
use Cowegis\Core\Serializer\Vector\CircleMarkerSerializer;
use PhpSpec\ObjectBehavior;

final class CircleMarkerSerializerSpec extends ObjectBehavior
{
    public function let(Serializer $serializer): void
    {
        $this->beConstructedWith($serializer);
    }

    public function it_is_initializable(): void
    {
        $this->shouldBeAnInstanceOf(CircleMarkerSerializer::class);
    }

    public function it_serializes_circle_marker(DefinitionId $definitionId): void
    {
        $polyline = new CircleMarker(
            new LayerId($definitionId->getWrappedObject()),
            'example',
            new LatLng(0.0, 0.0),
            true,
        );

        $definitionId->value()->willReturn('example_1');

        $this->serialize($polyline)->shouldReturn(
            [
                'layerId'        => 'example_1',
                'name'           => 'example',
                'title'          => 'example',
                'initialVisible' => true,
                'options'        => null,
                'events'         => null,
                'type'           => 'circleMarker',
                'center'         => [0.0, 0.0],
            ],
        );
    }
}
