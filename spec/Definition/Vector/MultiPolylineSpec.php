<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Definition\Vector;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Layer\LayerId;
use PhpSpec\ObjectBehavior;

final class MultiPolylineSpec extends ObjectBehavior
{
    public function it_contains_coordinates(DefinitionId $definitionId): void
    {
        $layerId     = new LayerId($definitionId->getWrappedObject());
        $coordinates = [new LatLngList([new LatLng(0, 0)]), new LatLngList([new LatLng(2, 1), new LatLng(-2, -1)])];

        $this->beConstructedWith($layerId, 'example', $coordinates, true);

        $this->getLatLngs()->shouldReturn($coordinates);
    }

    public function it_calculate_bounds(DefinitionId $definitionId): void
    {
        $layerId     = new LayerId($definitionId->getWrappedObject());
        $coordinates = [new LatLngList([new LatLng(0, 0)]), new LatLngList([new LatLng(2, 1), new LatLng(-2, -1)])];

        $this->beConstructedWith($layerId, 'example', $coordinates, true);

        $bounds = $this->getBounds();

        $bounds->north()->shouldBe(-2.0);
        $bounds->south()->shouldBe(2.0);
        $bounds->east()->shouldBe(1.0);
        $bounds->west()->shouldBe(-1.0);
    }
}
