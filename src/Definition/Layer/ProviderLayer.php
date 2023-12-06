<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

final class ProviderLayer extends GridLayer
{
    public function __construct(
        LayerId $layerId,
        string $name,
        private readonly string $provider,
        private readonly string|null $variant,
        bool $initialVisible,
    ) {
        parent::__construct($layerId, $name, $initialVisible);
    }

    public function provider(): string
    {
        return $this->provider;
    }

    public function variant(): string|null
    {
        return $this->variant;
    }
}
