<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider\LayerData;

use ArrayIterator;
use Cowegis\Core\Definition\Asset\Assets;
use Cowegis\Core\Definition\Expression\Callbacks;
use Cowegis\Core\Definition\UI\Marker;
use Cowegis\Core\Provider\LayerData;
use IteratorAggregate;

final class MarkersLayerData implements LayerData, IteratorAggregate
{
    /** @var Marker[] */
    private array $markers;

    private Callbacks $callbacks;

    private Assets $assets;

    /** @param Marker[] $markers */
    public function __construct(array $markers, Assets $assets, Callbacks $callbacks)
    {
        $this->markers   = $markers;
        $this->callbacks = $callbacks;
        $this->assets    = $assets;
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
