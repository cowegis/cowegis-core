<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use function is_numeric;
use function strpos;

final class NumberConstraint extends ConstraintWithDefault
{
    public function match($value) : bool
    {
        return is_numeric($value);
    }

    public function filter($value)
    {
        if (strpos((string) $value, '.') !== false) {
            return (float) $value;
        }

        return (int) $value;
    }
}
