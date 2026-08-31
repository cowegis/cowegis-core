<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Override;

abstract class BaseConstraint implements Constraint
{
    public function __construct(private readonly bool $required = false)
    {
    }

    #[Override]
    public function required(): bool
    {
        return $this->required;
    }
}
