<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use ArrayIterator;
use Countable;
use Cowegis\Core\Constraint\Constraints;
use IteratorAggregate;
use function array_key_exists;

final class Options implements IteratorAggregate, Countable
{
    /** @var Constraints */
    private $constraints;

    private $options = [];

    public function __construct(Constraints $constraints)
    {
        $this->constraints = $constraints;
    }

    public function merge(array $options) : self
    {
        foreach ($options as $key => $value) {
            $this->set($key, $value);
        }

        return $this;
    }

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

    public function get(string $key, $fallback = null)
    {
        if (array_key_exists($key, $this->options)) {
            return $this->options[$key];
        }

        return $this->constraints->defaultValueOf($key, $fallback);
    }

    public function has(string $key) : bool
    {
        return array_key_exists($key, $this->options);
    }

    public function count() : int
    {
        return count($this->options);
    }

    public function toArray() : array
    {
        return $this->options;
    }

    public function getIterator() : ArrayIterator
    {
        return new ArrayIterator($this->options);
    }
}
