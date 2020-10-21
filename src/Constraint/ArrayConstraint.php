<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use ArrayObject;

use function is_array;

final class ArrayConstraint extends ConstraintWithDefault
{
    /** {@inheritDoc} */
    public function match($value): bool
    {
        return is_array($value) || $value instanceof ArrayObject;
    }

    /** {@inheritDoc} */
    public function filter($value): array
    {
        if ($value instanceof ArrayObject) {
            return $value->getArrayCopy();
        }

        return $value;
    }
}
