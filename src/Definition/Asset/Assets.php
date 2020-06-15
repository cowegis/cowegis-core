<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Asset;

final class Assets
{
    /** @var Asset[] */
    private $assets;

    public function __construct(array $assets = [])
    {
        $this->assets = $assets;
    }

    public function add(Asset $asset) : void
    {
        $this->assets[] = $asset;
    }

    public function toArray() : array
    {
        return $this->assets;
    }
}
