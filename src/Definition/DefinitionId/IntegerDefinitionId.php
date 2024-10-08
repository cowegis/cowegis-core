<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\DefinitionId;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Exception\RuntimeException;

use function is_int;

final class IntegerDefinitionId implements DefinitionId
{
    public function __construct(private readonly int $value)
    {
    }

    public static function fromValue(mixed $value): DefinitionId
    {
        if (! is_int($value)) {
            throw new RuntimeException('Value has to be an int');
        }

        return new self($value);
    }

    public function value(): string
    {
        return (string) $this->value;
    }

    public function jsonSerialize(): int
    {
        return $this->value;
    }
}
