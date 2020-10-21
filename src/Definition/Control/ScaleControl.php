<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\IntegerConstraint;

final class ScaleControl extends Control
{
    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['maxWidth']       = IntegerConstraint::withDefaultValue(100);
        $constraints['metric']         = BooleanConstraint::withDefaultValue(true);
        $constraints['imperial']       = BooleanConstraint::withDefaultValue(true);
        $constraints['updateWhenIdle'] = BooleanConstraint::withDefaultValue(false);

        return $constraints;
    }

    protected function defaultPosition(): ?string
    {
        return 'bottomleft';
    }
}
