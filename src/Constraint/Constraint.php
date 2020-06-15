<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

interface Constraint
{
    public function match($value) : bool;

    public function filter($value);

    public function required() : bool;
}
