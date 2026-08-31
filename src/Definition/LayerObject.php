<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Map\Map;
use Override;

abstract class LayerObject implements Layer, HasOptions
{
    use OptionsPlugin;

    #[Override]
    abstract public function addTo(Map $map): void;

    /** {@inheritDoc} */
    #[Override]
    protected function optionConstraints(): array
    {
        return [
            'attribution' => new StringConstraint(),
        ];
    }
}
