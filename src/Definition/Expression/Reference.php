<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Expression;

use JsonSerializable;

use function implode;

/**
 * @psalm-type TSerializedReference array{type: 'reference', namespace: (list<string>|null), reference: string}
 */
final class Reference implements Expression, JsonSerializable
{
    private string $reference;

    /**
     * @var array<int, string>|null
     * @psalm-var list<string>|null
     */
    private ?array $namespace = null;

    /**
     * @param array<int, string> $namespace
     * @psalm-param list<string>|null $namespace
     */
    public function __construct(string $reference, ?array $namespace = null)
    {
        $this->reference = $reference;
        $this->namespace = $namespace;
    }

    public function toString(): string
    {
        if ($this->namespace === null) {
            return $this->reference;
        }

        return implode('.', $this->namespace) . '.' . $this->reference;
    }

    /**
     * @return array<string, mixed>
     * @psalm-return TSerializedReference
     */
    public function jsonSerialize(): array
    {
        return [
            'type'      => 'reference',
            'namespace' => $this->namespace,
            'reference' => $this->reference,
        ];
    }
}
