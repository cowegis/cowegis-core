<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use function is_numeric;

final class FloatConstraint extends ConstraintWithDefault
{
    /** {@inheritDoc} */
    public function match(mixed $value): bool
    {
        return is_numeric($value);
    }

    /** {@inheritDoc} */
    public function filter(mixed $value): float
    {
        return (float) $value;
    }
}
