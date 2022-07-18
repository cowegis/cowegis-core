<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Definition\Expression\Reference;
use Cowegis\Core\Definition\Layer\LayerIds;

final class LayersControl extends Control
{
    private LayerIds $baseLayers;

    private LayerIds $overlays;

    public function __construct(
        ControlId $controlId,
        string $name,
        ?LayerIds $baseLayers = null,
        ?LayerIds $overlays = null
    ) {
        parent::__construct($controlId, $name);

        $this->baseLayers = $baseLayers ?: new LayerIds();
        $this->overlays   = $overlays ?: new LayerIds();
    }

    public function baseLayers(): LayerIds
    {
        return $this->baseLayers;
    }

    public function overlays(): LayerIds
    {
        return $this->overlays;
    }

    protected function defaultPosition(): string
    {
        return Control::POSITION_TOP_RIGHT;
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['collapsed']      = BooleanConstraint::withDefaultValue(true);
        $constraints['autoZIndex']     = BooleanConstraint::withDefaultValue(true);
        $constraints['hideSingleBase'] = BooleanConstraint::withDefaultValue(false);
        $constraints['sortLayers']     = BooleanConstraint::withDefaultValue(false);
        $constraints['sortFunction']   = new InstanceOfConstraint(Reference::class);

        return $constraints;
    }
}
