<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Expression;

use JsonSerializable;

use function implode;

/**
 * @psalm-type TSerializedReference = array{
 *   type: 'reference',
 *   namespace: null|list<string>,
 *   reference: string
 * }
 */
final class Reference implements Expression, JsonSerializable
{
    /** @var string */
    private $reference;

    /** @var array<int, string>|null */
    private $namespace;

    /** @param array<int, string> $namespace */
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
     *
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
