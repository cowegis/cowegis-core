<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use function gettype;
use function in_array;
use function is_object;
use function method_exists;

final class StringConstraint extends ConstraintWithDefault
{
    public function match(mixed $value): bool
    {
        if (is_object($value) && method_exists($value, '__toString')) {
            return true;
        }

        return in_array(gettype($value), ['string', 'float', 'int'], true);
    }

    public function filter(mixed $value): string
    {
        return (string) $value;
    }
}
