<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\DefinitionId;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Exception\RuntimeException;
use Override;

abstract class DefinitionIdDecorator implements DefinitionId
{
    final public function __construct(private readonly DefinitionId $definitionId)
    {
    }

    #[Override]
    public static function fromValue(mixed $value): static
    {
        if (! $value instanceof DefinitionId) {
            throw new RuntimeException('Given value must be an instance of ' . DefinitionId::class);
        }

        return new static($value);
    }

    public function inner(): DefinitionId
    {
        return $this->definitionId;
    }

    #[Override]
    public function value(): string
    {
        return $this->definitionId->value();
    }

    #[Override]
    public function jsonSerialize(): mixed
    {
        return $this->definitionId->jsonSerialize();
    }
}
