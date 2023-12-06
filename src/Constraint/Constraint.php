<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

interface Constraint
{
    public function match(mixed $value): bool;

    public function filter(mixed $value): mixed;

    public function required(): bool;
}
