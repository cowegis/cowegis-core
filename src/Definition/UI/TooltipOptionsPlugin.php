<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\UI;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\EnumConstraint;
use Cowegis\Core\Constraint\FloatConstraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Definition\Map\PaneId;
use Cowegis\Core\Definition\Point;

trait TooltipOptionsPlugin
{
    protected function tooltipOptionsConstraints(array $constraints) : array
    {
        return array_merge(
            $constraints,
            [
                'pane'        => InstanceOfConstraint::withDefaultValue(PaneId::class, 'tooltipPane'),
                'offset'      => InstanceOfConstraint::withDefaultValue(Point::class, new Point(0, 0)),
                'direction'   => EnumConstraint::withDefaultValue(
                    ['auto', 'right', 'left', 'top', 'bottom', 'center'],
                    'auto'
                ),
                'permanent'   => BooleanConstraint::withDefaultValue(false),
                'sticky'      => BooleanConstraint::withDefaultValue(false),
                'interactive' => BooleanConstraint::withDefaultValue(false),
                'opacity'     => FloatConstraint::withDefaultValue(0.9),
            ]
        );
    }
}
