<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Definition\Vector;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LatLngBounds;
use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Vector\Rectangle;
use PhpSpec\ObjectBehavior;

final class RectangleSpec extends ObjectBehavior
{
    public function let(DefinitionId $definitionId): void
    {
        $this->beConstructedWith(
            new LayerId($definitionId->getWrappedObject()),
            'rectangle',
            new LatLngBounds(new LatLng(0, 0), new LatLng(1, 0)),
        );
    }

    public function it_is_initializable(): void
    {
        $this->shouldBeAnInstanceOf(Rectangle::class);
    }

    public function it_has_bounds(): void
    {
        $this->bounds()->jsonSerialize()->shouldReturn([[0.0, 0.0], [1.0, 0.0]]);
    }
}
