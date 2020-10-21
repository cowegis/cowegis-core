<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Map\Map;

abstract class LayerObject implements Layer, HasOptions
{
    use OptionsPlugin;

    abstract public function addTo(Map $map): void;

    /** {@inheritDoc} */
    protected function optionConstraints(): array
    {
        return [
            'attribution' => new StringConstraint(),
        ];
    }
}
