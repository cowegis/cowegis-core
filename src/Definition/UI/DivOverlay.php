<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\UI;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Event\EventsPlugin;
use Cowegis\Core\Definition\HasEvents;
use Cowegis\Core\Definition\LayerObject;
use Cowegis\Core\Definition\Map\PaneId;
use Cowegis\Core\Definition\Point;

abstract class DivOverlay extends LayerObject implements HasEvents
{
    use EventsPlugin;

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints              = parent::optionConstraints();
        $constraints['offset']    = InstanceOfConstraint::withDefaultValue(Point::class, new Point(0, 7));
        $constraints['className'] = StringConstraint::withDefaultValue('');
        $constraints['pane']      = InstanceOfConstraint::withDefaultValue(PaneId::class, 'popupPane');

        return $constraints;
    }
}
