<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Override;

use function in_array;

final class BooleanConstraint extends ConstraintWithDefault
{
    /** {@inheritDoc} */
    #[Override]
    public function match(mixed $value): bool
    {
        return in_array($value, ['1', '0', '', 1, 0, false, true, null], true);
    }

    /** {@inheritDoc} */
    #[Override]
    public function filter(mixed $value): bool
    {
        return (bool) $value;
    }
}
