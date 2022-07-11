<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Vector;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\FloatConstraint;

abstract class PolylineObject extends Path
{
    /** {@inheritDoc} */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['smoothFactor'] = FloatConstraint::withDefaultValue(1.0);
        $constraints['noClip']       = BooleanConstraint::withDefaultValue(false);

        return $constraints;
    }
}
