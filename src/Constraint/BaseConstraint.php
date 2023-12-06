<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

abstract class BaseConstraint implements Constraint
{
    public function __construct(private readonly bool $required = false)
    {
    }

    public function required(): bool
    {
        return $this->required;
    }
}
