<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

final class ProviderLayer extends GridLayer
{
    /** @var string */
    private $provider;

    /** @var string|null */
    private $variant;

    public function __construct(
        LayerId $layerId,
        string $name,
        string $provider,
        ?string $variant,
        bool $initialVisible
    ) {
        parent::__construct($layerId, $name, $initialVisible);

        $this->provider = $provider;
        $this->variant  = $variant;
    }

    public function provider(): string
    {
        return $this->provider;
    }

    public function variant(): ?string
    {
        return $this->variant;
    }
}
