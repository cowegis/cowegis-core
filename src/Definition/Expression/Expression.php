<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Expression;

interface Expression
{
    public function toString(): string;
}
