<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoData;

final class Properties
{
    /** @var array<string, mixed> */
    private array $properties = [];

    /** @param array<string, mixed> $data */
    public function merge(array $data): void
    {
        /** @psalm-var mixed $value */
        foreach ($data as $key => $value) {
            $this->properties[$key] = $value;
        }
    }

    public function set(string $name, mixed $value): void
    {
        $this->properties[$name] = $value;
    }

    public function get(string $name, mixed $default = null): mixed
    {
        return $this->properties[$name] ?? $default;
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return $this->properties;
    }
}
