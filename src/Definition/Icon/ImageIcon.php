<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Icon;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Point;

final class ImageIcon extends BaseIcon
{
    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['iconUrl']         = new StringConstraint();
        $constraints['iconRetinaUrl']   = new StringConstraint();
        $constraints['iconSize']        = new InstanceOfConstraint(Point::class);
        $constraints['shadowUrl']       = new StringConstraint();
        $constraints['shadowRetinaUrl'] = new StringConstraint();
        $constraints['shadowSize']      = new InstanceOfConstraint(Point::class);
        $constraints['shadowAnchor']    = new InstanceOfConstraint(Point::class);

        return $constraints;
    }
}
