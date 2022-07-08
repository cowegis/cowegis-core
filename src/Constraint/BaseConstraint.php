<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

abstract class BaseConstraint implements Constraint
{
    private bool $required;

    public function __construct(bool $required = false)
    {
        $this->required = $required;
    }

    public function required(): bool
    {
        return $this->required;
    }
}
