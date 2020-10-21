<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Map;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\FloatConstraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Definition\HasOptions;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\OptionsPlugin;
use Cowegis\Core\Definition\Point;

final class View implements HasOptions
{
    use OptionsPlugin;

    /** @var LatLng|null */
    private $center;

    /** @var float|null */
    private $zoom;

    public function changeView(?LatLng $center, ?float $zoom): void
    {
        $this->center = $center;
        $this->zoom   = $zoom;
    }

    public function center(): ?LatLng
    {
        return $this->center;
    }

    public function zoom(): ?float
    {
        return $this->zoom;
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        return [
            'paddingTopLeft'     => InstanceOfConstraint::withDefaultValue(Point::class, new Point(0, 0)),
            'paddingBottomRight' => InstanceOfConstraint::withDefaultValue(Point::class, new Point(0, 0)),
            'padding'            => InstanceOfConstraint::withDefaultValue(Point::class, new Point(0, 0)),
            'maxZoom'            => new FloatConstraint(),
        ];
    }
}
