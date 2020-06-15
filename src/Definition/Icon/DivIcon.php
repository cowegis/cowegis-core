<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Icon;

use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Point;

final class DivIcon extends BaseIcon
{
    protected function optionConstraints() : array
    {
        $constraints = parent::optionConstraints();

        $constraints['html']  = StringConstraint::withDefaultValue('');
        $constraints['bgPos'] = InstanceOfConstraint::withDefaultValue(Point::class, new Point(0, 0));

        return $constraints;
    }
}
