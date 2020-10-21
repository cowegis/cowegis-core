<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Constraint\ArrayConstraint;
use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\FloatConstraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;

final class LoadingControl extends Control
{
    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['separate']       = BooleanConstraint::withDefaultValue(false);
        $constraints['zoomControl']    = new InstanceOfConstraint(ControlId::class);
        $constraints['delayIndicator'] = new FloatConstraint();
        $constraints['spinjs']         = BooleanConstraint::withDefaultValue(false);
        $constraints['spin']           = new ArrayConstraint();

        return $constraints;
    }

    protected function defaultPosition(): ?string
    {
        return 'topleft';
    }
}
