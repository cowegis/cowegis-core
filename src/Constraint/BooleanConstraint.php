<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use function in_array;

final class BooleanConstraint extends ConstraintWithDefault
{
    public function match($value) : bool
    {
        return in_array($value, ['1', '0', '', 1, 0, false, true, null], true);
    }

    public function filter($value) : bool
    {
        return (bool) $value;
    }
}
