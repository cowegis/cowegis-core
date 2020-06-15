<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter;

use function array_key_exists;

final class Query
{
    /** @var array */
    private $params = [];

    public static function fromArray(array $params) : self
    {
        $query         = new self();
        $query->params = $params;

        return $query;
    }

    public function with(string $name, $value) : self
    {
        $instance = clone $this;
        $instance->params[$name] = $value;

        return $instance;
    }

    public function get(string $name, $default = null)
    {
        return $this->params[$name] ?? $default;
    }

    public function getArray(string $name, array $default = []) : array
    {
        return (array) $this->get($name, $default);
    }

    public function getString(string $name, string $default = '') : string
    {
        return (string) $this->get($name, $default);
    }

    public function has(string $name) : bool
    {
        return array_key_exists($name, $this->params);
    }

    public function toArray() : array
    {
        return $this->params;
    }
}
