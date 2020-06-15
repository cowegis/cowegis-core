<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use ArrayObject;
use function is_array;

final class ArrayConstraint extends ConstraintWithDefault
{
    public function match($value) : bool
    {
        return is_array($value) || $value instanceof ArrayObject;
    }

    public function filter($value) : array
    {
        if ($value instanceof ArrayObject) {
            return $value->getArrayCopy();
        }

        return $value;
    }
}
