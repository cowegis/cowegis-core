<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoJson;

final class Properties
{
    /** @var array<string, mixed> */
    private $properties = [];

    /** @param array<string, mixed> $data */
    public function merge(array $data): void
    {
        /** @psalm-var mixed $value */
        foreach ($data as $key => $value) {
            $this->properties[$key] = $value;
        }
    }

    /** @param mixed $value */
    public function set(string $name, $value): void
    {
        $this->properties[$name] = $value;
    }

    /**
     * @param mixed $default
     *
     * @return mixed
     */
    public function get(string $name, $default = null)
    {
        return $this->properties[$name] ?? $default;
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return $this->properties;
    }
}
