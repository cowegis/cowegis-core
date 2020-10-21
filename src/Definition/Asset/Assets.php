<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Asset;

final class Assets
{
    /** @var Asset[] */
    private $assets;

    /** @param Asset[] $assets */
    public function __construct(array $assets = [])
    {
        $this->assets = $assets;
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
