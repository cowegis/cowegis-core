<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use function is_numeric;
use function strpos;

final class IntegerConstraint extends ConstraintWithDefault
{
    public function match(mixed $value): bool
    {
        return is_numeric($value) && strpos((string) $value, '.') === false;
    }

    public function filter(mixed $value): int
    {
        return (int) $value;
    }
}
