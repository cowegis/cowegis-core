<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use function is_numeric;

final class FloatConstraint extends ConstraintWithDefault
{
    public function match($value) : bool
    {
        return is_numeric($value);
    }

    public function filter($value): float
    {
        return (float) $value;
    }
}
