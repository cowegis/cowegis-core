<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use ArrayIterator;
use Countable;
use Cowegis\Core\Constraint\Constraints;
use IteratorAggregate;

use function array_key_exists;
use function count;

final class Options implements IteratorAggregate, Countable
{
    /** @var Constraints */
    private $constraints;

    /** @var array<string, mixed> */
    private $options = [];

    public function __construct(Constraints $constraints)
    {
        $this->constraints = $constraints;
    }

    /** @param array<string, mixed> $options */
    public function merge(array $options): self
    {
        foreach ($options as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

    /** @param mixed $value */
    public function set(string $key, $value): self
    {
        $value = $this->constraints->filterValue($key, $value);

        if ($this->constraints->isDefaultValueOf($key, $value)) {
            unset($this->options[$key]);
        } else {
            $this->options[$key] = $value;
        }

        return $this;
    }

    /**
     * @param mixed $fallback
     *
     * @return mixed
     */
    public function get(string $key, $fallback = null)
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
