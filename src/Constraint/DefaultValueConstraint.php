<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

final class DefaultValueConstraint implements Constraint
{
    /** @var Constraint */
    private $constraint;

    /** @var mixed */
    private $value;

    /** @param mixed $value */
    public function __construct(Constraint $constraint, $value)
    {
        $this->value      = $value;
        $this->constraint = $constraint;
    }

    public function required(): bool
    {
        return false;
    }

    /** @return mixed */
    public function defaultValue()
    {
        return $this->value;
    }

    /** {@inheritDoc} */
    public function match($value): bool
    {
        return $this->constraint->match($value);
    }

    /** {@inheritDoc} */
    public function filter($value)
    {
        return $this->constraint->filter($value);
    }
}
