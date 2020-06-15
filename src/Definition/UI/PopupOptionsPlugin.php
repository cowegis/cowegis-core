<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\UI;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\IntegerConstraint;
use Cowegis\Core\Definition\Point;

trait PopupOptionsPlugin
{
    protected function popupOptionsConstraints(array $constraints) : array
    {
        $constraints['maxWidth']                  = IntegerConstraint::withDefaultValue(300);
        $constraints['minWidth']                  = IntegerConstraint::withDefaultValue(50);
        $constraints['maxHeight']                 = new IntegerConstraint();
        $constraints['autoPan']                   = BooleanConstraint::withDefaultValue(true);
        $constraints['autoPanPaddingTopLeft']     = new InstanceOfConstraint(Point::class);
        $constraints['autoPanPaddingBottomRight'] = new InstanceOfConstraint(Point::class);
        $constraints['autoPanPadding']            = InstanceOfConstraint::withDefaultValue(Point::class, new Point(5, 5));
        $constraints['keepInView']                = BooleanConstraint::withDefaultValue(false);
        $constraints['closeButton']               = BooleanConstraint::withDefaultValue(false);
        $constraints['autoClose']                 = BooleanConstraint::withDefaultValue(true);
        $constraints['closeOnEscapeKey']          = BooleanConstraint::withDefaultValue(true);
        $constraints['closeOnClick']              = new BooleanConstraint();

        return $constraints;
    }
}
