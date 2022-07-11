<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Vector;

use Cowegis\Core\Constraint\NumberConstraint;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\Layer\LayerId;

abstract class CircleObject extends Path
{
    private LatLng $center;

    public function __construct(LayerId $layerId, string $name, LatLng $center, bool $initialVisible = true)
    {
        parent::__construct($layerId, $name, $initialVisible);

        $this->center = $center;
    }

    /** {@inheritDoc} */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['radius'] = NumberConstraint::withDefaultValue(10);

        return $constraints;
    }

    public function center(): LatLng
    {
        return $this->center;
    }
}
