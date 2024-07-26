<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use ArrayIterator;
use Countable;
use Cowegis\Core\Constraint\Constraints;
use IteratorAggregate;

use function array_key_exists;
use function count;

/** @implements IteratorAggregate<string,mixed> */
final class Options implements IteratorAggregate, Countable
{
    /** @var array<string, mixed> */
    private array $options = [];

    public function __construct(private readonly Constraints $constraints)
    {
    }

    /** @param array<string, mixed> $options */
    public function merge(array $options): self
    {
        /** @psalm-var mixed $value */
        foreach ($options as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    public function set(string $key, mixed $value): self
    {
        /** @psalm-var mixed $value */
        $value = $this->constraints->filterValue($key, $value);

        if ($this->constraints->isDefaultValueOf($key, $value) === true) {
            unset($this->options[$key]);
        } else {
            $this->options[$key] = $value;
        }

        return $this;
    }

    public function get(string $key, mixed $fallback = null): mixed
    {
        if (array_key_exists($key, $this->options)) {
            return $this->options[$key];
        }

        return $this->constraints->defaultValueOf($key, $fallback);
    }

    public function has(string $key): bool
    {
        return array_key_exists($key, $this->options);
    }

    public function count(): int
    {
        return count($this->options);
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return $this->options;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->options);
    }
}
