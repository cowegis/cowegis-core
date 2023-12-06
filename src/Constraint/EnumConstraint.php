<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use function in_array;

final class EnumConstraint extends BaseConstraint
{
    /** @param array<int,mixed> $values */
    public function __construct(private readonly array $values, bool $required = false)
    {
        parent::__construct($required);
    }

    /** @param array<int,mixed> $values */
    public static function withDefaultValue(array $values, mixed $defaultValue): Constraint
    {
        return new DefaultValueConstraint(new self($values), $defaultValue);
    }

    /** @param array<int,mixed> $values */
    public static function asRequired(array $values): Constraint
    {
        return new self($values, true);
    }

    public function match(mixed $value): bool
    {
        return in_array($value, $this->values, true);
    }

    public function filter(mixed $value): mixed
    {
        /** @psalm-var mixed $allowed */
        foreach ($this->values as $allowed) {
            if ($allowed === $value) {
                return $allowed;
            }
        }

        return null;
    }
}
