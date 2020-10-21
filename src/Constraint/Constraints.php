<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Generator;

final class Constraints
{
    /** @var Constraint[] */
    private $constraints;

    /**
     * @param Constraint[] $constraints
     */
    public function __construct(array $constraints)
    {
        $this->constraints = $constraints;
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

    /** @param mixed $value */
    public function isDefaultValueOf(string $key, $value): ?bool
    {
        if (! isset($this->constraints[$key])) {
            return null;
        }

        if (! $this->constraints[$key] instanceof DefaultValueConstraint) {
            return null;
        }

        return $this->constraints[$key]->defaultValue() === $value;
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    public function filterValue(string $key, $value)
    {
        if (! isset($this->constraints[$key])) {
            return $value;
        }

        return $this->constraints[$key]->filter($value);
    }

    /**
     * @param mixed $fallback
     *
     * @return mixed
     */
    public function defaultValueOf(string $key, $fallback = null)
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
