<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Expression;

final class InlineExpression implements Expression
{
    public function __construct(private readonly string $code)
    {
    }

    public function toString(): string
    {
        return $this->code;
    }
}
