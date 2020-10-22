<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use function in_array;

final class EnumConstraint extends BaseConstraint
{
    /** @var array<int,mixed> */
    private $values;

    /** @param array<int,mixed> $values */
    public function __construct(array $values, bool $required = false)
    {
        parent::__construct($required);

        $this->values = $values;
    }

    /**
     * @param array<int,mixed> $values
     * @param mixed            $defaultValue
     */
    public static function withDefaultValue(array $values, $defaultValue): Constraint
    {
        return new DefaultValueConstraint(new self($values), $defaultValue);
    }

    /** @param array<int,mixed> $values */
    public static function asRequired(array $values): Constraint
    {
        return new self($values, true);
    }

    /** {@inheritDoc} */
    public function match($value): bool
    {
        return in_array($value, $this->values, true);
    }

    /** {@inheritDoc} */
    public function filter($value)
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
