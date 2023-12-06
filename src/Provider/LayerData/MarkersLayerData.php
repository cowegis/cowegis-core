<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider\LayerData;

use ArrayIterator;
use Cowegis\Core\Definition\Asset\Assets;
use Cowegis\Core\Definition\Expression\Callbacks;
use Cowegis\Core\Definition\UI\Marker;
use Cowegis\Core\Provider\LayerData;
use IteratorAggregate;

/** @implements IteratorAggregate<Marker> */
final class MarkersLayerData implements LayerData, IteratorAggregate
{
    /** @param Marker[] $markers */
    public function __construct(
        private readonly array $markers,
        private readonly Assets $assets,
        private readonly Callbacks $callbacks,
    ) {
    }

    public function assets(): Assets
    {
        return $this->assets;
    }

    public function callbacks(): Callbacks
    {
        return $this->callbacks;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->markers);
    }
}
