<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Constraint\StringConstraint;

final class AttributionControl extends Control
{
    /** @var string[] */
    private $attributions = [];

    /** @var bool */
    private $replaceDefault = false;

    protected function optionConstraints() : array
    {
        $constraints           = parent::optionConstraints();
        $constraints['prefix'] = new StringConstraint();

        return $constraints;
    }

    protected function defaultPosition() : ?string
    {
        return 'bottomright';
    }

    public function attributions() : array
    {
        return $this->attributions;
    }

    public function replaceDefault() : void
    {
        $this->replaceDefault = true;
    }

    public function replacesDefault() : bool
    {
        return $this->replaceDefault;
    }

    public function addAttribution(string $attribution) : void
    {
        $this->attributions[] = $attribution;
    }
}
