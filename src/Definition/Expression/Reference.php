<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Expression;

use JsonSerializable;
use function implode;

final class Reference implements Expression, JsonSerializable
{
    /** @var string */
    private $reference;

    /** @var array|null */
    private $namespace;

    public function __construct(string $reference, ?array $namespace = null)
    {
        $this->reference = $reference;
        $this->namespace = $namespace;
    }

    public function toString() : string
    {
        if ($this->namespace === null) {
            return $this->reference;
        }

        return implode('.', $this->namespace) . '.' . $this->reference;
    }

    public function jsonSerialize()
    {
        return [
            'type'      => 'reference',
            'namespace' => $this->namespace,
            'reference' => $this->reference,
        ];
    }
}
