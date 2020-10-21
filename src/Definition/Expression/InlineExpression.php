<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Expression;

final class InlineExpression implements Expression
{
    /** @var string */
    private $code;

    public function __construct(string $code)
    {
        $this->code = $code;
    }

    public function toString(): string
    {
        return $this->code;
    }
}
