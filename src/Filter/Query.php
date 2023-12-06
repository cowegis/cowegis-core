<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter;

use function array_key_exists;
use function assert;
use function is_array;
use function is_string;

/**
 * @psalm-type TArrayParam = array<array-key, string|array<array-key, mixed>>
 * @psalm-type TParam = string|TArrayParam
 * @psalm-type TParams = array<string, TParam>
 */
final class Query
{
    /**
     * @var array<string,mixed>
     * @psalm-var TParams
     */
    private array $params = [];

    /**
     * @param array<string,mixed> $params
     * @psalm-param TParams $params
     */
    public static function fromArray(array $params): self
    {
        $query         = new self();
        $query->params = $params;

        return $query;
    }

    /** @param string|array<string,string> $value */
    public function with(string $name, string|array $value): self
    {
        $instance                = clone $this;
        $instance->params[$name] = $value;

        return $instance;
    }

    /**
     * @param string|array<string,string> $default
     * @psalm-param TParam $default
     *
     * @return string|array<string, mixed>|null
     * @psalm-return TParam|null
     */
    public function get(string $name, string|array|null $default = null): string|array|null
    {
        return $this->params[$name] ?? $default;
    }

    /**
     * @param array<string, mixed> $default
     * @psalm-param TArrayParam $default
     *
     * @return array<array-key,string>
     * @psalm-return TArrayParam
     */
    public function getArray(string $name, array $default = []): array
    {
        $value = $this->get($name, $default);
        assert(is_array($value));

        return $value;
    }

    public function getString(string $name, string $default = ''): string
    {
        $value = $this->get($name, $default);
        assert(is_string($value));

        return $value;
    }

    public function has(string $name): bool
    {
        return array_key_exists($name, $this->params);
    }

    /** @return array<string, mixed> */
    public function toArray(): array
    {
        return $this->params;
    }
}
