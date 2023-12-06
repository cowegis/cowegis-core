<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Expression;

use JsonSerializable;

use function implode;

/** @psalm-type TSerializedReference array{type: 'reference', namespace: (list<string>|null), reference: string} */
final class Reference implements Expression, JsonSerializable
{
    /** @param list<string>|null $namespace */
    public function __construct(private readonly string $reference, private readonly array|null $namespace = null)
    {
    }

    public function toString(): string
    {
        if ($this->namespace === null) {
            return $this->reference;
        }

        return implode('.', $this->namespace) . '.' . $this->reference;
    }

    /** @return TSerializedReference */
    public function jsonSerialize(): array
    {
        return [
            'type'      => 'reference',
            'namespace' => $this->namespace,
            'reference' => $this->reference,
        ];
    }
}
