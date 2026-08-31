<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Override;

final class DefaultValueConstraint implements Constraint
{
    public function __construct(private readonly Constraint $constraint, private readonly mixed $value)
    {
    }

    #[Override]
    public function required(): bool
    {
        return false;
    }

    public function defaultValue(): mixed
    {
        return $this->value;
    }

    #[Override]
    public function match(mixed $value): bool
    {
        return $this->constraint->match($value);
    }

    #[Override]
    public function filter(mixed $value): mixed
    {
        return $this->constraint->filter($value);
    }
}
