<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use function in_array;

final class BooleanConstraint extends ConstraintWithDefault
{
    /** {@inheritDoc} */
    public function match(mixed $value): bool
    {
        return in_array($value, ['1', '0', '', 1, 0, false, true, null], true);
    }

    /** {@inheritDoc} */
    public function filter(mixed $value): bool
    {
        return (bool) $value;
    }
}
