<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use ArrayObject;
use Override;

use function is_array;

final class ArrayConstraint extends ConstraintWithDefault
{
    #[Override]
    public function match(mixed $value): bool
    {
        return is_array($value) || $value instanceof ArrayObject;
    }

    /**
     * @psalm-param array<array-key, mixed>|ArrayObject $value
     *
     * @return array<array-key, mixed>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    #[Override]
    public function filter(mixed $value): array
    {
        if ($value instanceof ArrayObject) {
            return $value->getArrayCopy();
        }

        return $value;
    }
}
