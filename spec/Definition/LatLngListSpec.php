<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Definition;

use Countable;
use Cowegis\Core\Definition\LatLng;
use PhpSpec\ObjectBehavior;
use Traversable;

final class LatLngListSpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beConstructedWith([new LatLng(0.0, 0.0), new LatLng(1.0, 1.0)]);
    }

    public function it_is_countable(): void
    {
        $this->shouldBeAnInstanceOf(Countable::class);

        $this->count()->shouldReturn(2);
    }

    public function it_serializes_to_json(): void
    {
        $this->jsonSerialize()->shouldReturn([[0.0, 0.0], [1.0, 1.0]]);
    }

    public function it_is_immutable(): void
    {
        $list = $this->add(new LatLng(2.0, 2.0));

        $list->count()->shouldReturn(3);
        $this->count()->shouldReturn(2);
    }

    public function it_is_iterable(): void
    {
        $coordinateA = new LatLng(0.0, 0.0);
        $coordinateB = new LatLng(1.0, 1.0);

        $this->beConstructedWith([$coordinateA, $coordinateB]);
        $this->shouldBeAnInstanceOf(Traversable::class);
        $this->shouldIterateAs([$coordinateA, $coordinateB]);
    }

    public function it_has_bounds(): void
    {
        $this->bounds()->north()->shouldBe(0.0);
        $this->bounds()->south()->shouldBe(1.0);
        $this->bounds()->west()->shouldBe(0.0);
        $this->bounds()->east()->shouldBe(1.0);
    }
}
