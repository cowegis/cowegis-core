<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\StringConstraint;

final class FullscreenControl extends Control
{
    protected function defaultPosition(): ?string
    {
        return 'topleft';
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['title']                 = new StringConstraint();
        $constraints['titleCancel']           = new StringConstraint();
        $constraints['forceSeparateButton']   = BooleanConstraint::withDefaultValue(false);
        $constraints['forcePseudoFullscreen'] = BooleanConstraint::withDefaultValue(false);

        return $constraints;
    }
}
