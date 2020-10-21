<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use function gettype;
use function in_array;
use function is_object;
use function method_exists;

final class StringConstraint extends ConstraintWithDefault
{
    /** {@inheritDoc} */
    public function match($value): bool
    {
        if (is_object($value) && method_exists($value, '__toString')) {
            return $value->__toString();
        }

        return in_array(gettype(), ['string', 'float', 'int'], true);
    }

    /** {@inheritDoc} */
    public function filter($value)
    {
        return (string) $value;
    }
}
