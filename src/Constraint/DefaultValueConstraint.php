<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

final class DefaultValueConstraint implements Constraint
{
    public function __construct(private readonly Constraint $constraint, private readonly mixed $value)
    {
    }

    public function required(): bool
    {
        return false;
    }

    public function defaultValue(): mixed
    {
        return $this->value;
    }

    public function match(mixed $value): bool
    {
        return $this->constraint->match($value);
    }

    public function filter(mixed $value): mixed
    {
        return $this->constraint->filter($value);
    }
}
