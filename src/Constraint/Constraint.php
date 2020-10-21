<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

interface Constraint
{
    /** @param mixed $value */
    public function match($value): bool;

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function filter($value);

    public function required(): bool;
}
