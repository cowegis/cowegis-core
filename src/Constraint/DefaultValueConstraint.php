<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

final class DefaultValueConstraint implements Constraint
{
    /** @var Constraint */
    private $constraint;

    /** @var mixed */
    private $value;

    public function __construct(Constraint $constraint, $value)
    {
        $this->value = $value;
        $this->constraint = $constraint;
    }

    public function required() : bool
    {
        return false;
    }

    public function defaultValue()
    {
        return $this->value;
    }

    public function match($value) : bool
    {
        return $this->constraint->match($value);
    }

    public function filter($value)
    {
        return $this->constraint->filter($value);
    }
}
