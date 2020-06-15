<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Map\Map;

abstract class LayerObject implements Layer, HasOptions
{
    use OptionsPlugin;

    public function addTo(Map $map) : void
    {
        $map->layers()->add($this);
    }

    /** @return Constraint[] */
    protected function optionConstraints() : array
    {
        return [
            'attribution' => new StringConstraint()
        ];
    }
}
