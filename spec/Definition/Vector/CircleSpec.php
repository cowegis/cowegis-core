<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Definition\Vector;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Vector\Circle;
use PhpSpec\ObjectBehavior;

final class CircleSpec extends ObjectBehavior
{
    public function let(DefinitionId $definitionId): void
    {
        $this->beConstructedWith(new LayerId($definitionId->getWrappedObject()), 'circle', new LatLng(0, 0));
    }

    public function it_is_initializable(): void
    {
        $this->shouldBeAnInstanceOf(Circle::class);
    }

    public function it_has_a_center(): void
    {
        $this->center()->equals(new LatLng(0, 0))->shouldReturn(true);
    }

    public function it_has_a_default_radius(): void
    {
        $this->options()->get('radius')->shouldReturn(10);
    }
}
