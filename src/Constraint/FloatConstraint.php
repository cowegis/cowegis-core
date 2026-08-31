<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Override;

use function is_numeric;

final class FloatConstraint extends ConstraintWithDefault
{
    /** {@inheritDoc} */
    #[Override]
    public function match(mixed $value): bool
    {
        return is_numeric($value);
    }

    /** {@inheritDoc} */
    #[Override]
    public function filter(mixed $value): float
    {
        return (float) $value;
    }
}
