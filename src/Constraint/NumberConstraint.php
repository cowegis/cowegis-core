<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Override;

use function is_numeric;
use function str_contains;

final class NumberConstraint extends ConstraintWithDefault
{
    #[Override]
    public function match(mixed $value): bool
    {
        return is_numeric($value);
    }

    #[Override]
    public function filter(mixed $value): int|float
    {
        if (str_contains((string) $value, '.')) {
            return (float) $value;
        }

        return (int) $value;
    }
}
