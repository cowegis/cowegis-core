<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\StringConstraint;

final class ZoomControl extends Control
{
    /** @var bool */
    private $replaceDefault = false;

    public function replaceDefault(): void
    {
        $this->replaceDefault = true;
    }

    public function replacesDefault(): bool
    {
        return $this->replaceDefault;
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints                 = parent::optionConstraints();
        $constraints['zoomInText']   = StringConstraint::withDefaultValue('+');
        $constraints['zoomInTitle']  = StringConstraint::withDefaultValue('Zoom in');
        $constraints['zoomOutText']  = StringConstraint::withDefaultValue('-');
        $constraints['zoomOutTitle'] = StringConstraint::withDefaultValue('Zoom out');

        return $constraints;
    }

    protected function defaultPosition(): ?string
    {
        return 'topleft';
    }
}
