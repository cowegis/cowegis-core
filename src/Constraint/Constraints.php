<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Generator;

final class Constraints
{
    /** @param Constraint[] $constraints */
    public function __construct(private readonly array $constraints)
    {
    }

    public function requiredKeys(): Generator
    {
        foreach ($this->constraints as $key => $constraint) {
            if (! $constraint->required()) {
                continue;
            }

            yield $key;
        }
    }

    public function isDefaultValueOf(string $key, mixed $value): bool|null
    {
        if (! isset($this->constraints[$key])) {
            return null;
        }

        if (! $this->constraints[$key] instanceof DefaultValueConstraint) {
            return null;
        }

        return $this->constraints[$key]->defaultValue() === $value;
    }

    public function filterValue(string $key, mixed $value): mixed
    {
        if (! isset($this->constraints[$key])) {
            return $value;
        }

        return $this->constraints[$key]->filter($value);
    }

    public function defaultValueOf(string $key, mixed $fallback = null): mixed
    {
        if (! isset($this->constraints[$key])) {
            return $fallback;
        }

        if (! $this->constraints[$key] instanceof DefaultValueConstraint) {
            return $fallback;
        }

        return $this->constraints[$key]->defaultValue();
    }
}
