<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Definition;

use Cowegis\Core\Definition\LatLng;
use PhpSpec\ObjectBehavior;

final class LatLngBoundsSpec extends ObjectBehavior
{
    public function it_constructs_from_coordinates(): void
    {
        $coordinates = [new LatLng(0, 0), new LatLng(2, 1), new LatLng(-2, -1)];
        $this->beConstructedThrough('fromCoordinates', [$coordinates]);

        $this->north()->shouldBe(-2.0);
        $this->south()->shouldBe(2.0);
        $this->east()->shouldBe(1.0);
        $this->west()->shouldBe(-1.0);
    }
}
