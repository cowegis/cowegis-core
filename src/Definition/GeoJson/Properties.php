<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoJson;

final class Properties
{
    private $properties = [];

    public function merge(array $data) : void
    {
        foreach ($data as $key => $value) {
            $this->properties[$key] = $value;
        }
    }

    public function set(string $name, $value) : void
    {
        $this->properties[$name] = $value;
    }

    public function get(string $name, $default = null)
    {
        return $this->properties[$name] ?? $default;
    }

    public function toArray() : array
    {
        return $this->properties;
    }
}
