<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Asset;

final class Assets
{
    /** @param Asset[] $assets */
    public function __construct(private array $assets = [])
    {
    }

    public function add(Asset $asset): void
    {
        $this->assets[] = $asset;
    }

    /** @return Asset[] */
    public function toArray(): array
    {
        return $this->assets;
    }
}
