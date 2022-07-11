<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Vector;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\FloatConstraint;
use Cowegis\Core\Constraint\NumberConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Event\EventsPlugin;
use Cowegis\Core\Definition\Layer\Layer;

abstract class Path extends Layer
{
    use EventsPlugin;

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['stroke']              = BooleanConstraint::withDefaultValue(true);
        $constraints['color']               = StringConstraint::withDefaultValue('#3388ff');
        $constraints['width']               = NumberConstraint::withDefaultValue(3);
        $constraints['opacity']             = FloatConstraint::withDefaultValue(1.0);
        $constraints['lineCap']             = StringConstraint::withDefaultValue('round');
        $constraints['lineJoin']            = StringConstraint::withDefaultValue('round');
        $constraints['dashArray']           = StringConstraint::withDefaultValue(null);
        $constraints['dashOffset']          = StringConstraint::withDefaultValue(null);
        $constraints['fill']                = new BooleanConstraint();
        $constraints['fillColor']           = StringConstraint::withDefaultValue('*');
        $constraints['fillOpacity']         = FloatConstraint::withDefaultValue(0.2);
        $constraints['fillRule']            = StringConstraint::withDefaultValue('evenodd');
        $constraints['bubblingMouseEvents'] = BooleanConstraint::withDefaultValue(true);
        $constraints['className']           = StringConstraint::withDefaultValue(null);

        return $constraints;
    }
}
