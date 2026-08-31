<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Expression;

use Override;

final class InlineExpression implements Expression
{
    public function __construct(private readonly string $code)
    {
    }

    #[Override]
    public function toString(): string
    {
        return $this->code;
    }
}
