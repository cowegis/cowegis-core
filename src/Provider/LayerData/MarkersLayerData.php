<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider\LayerData;

use ArrayIterator;
use Cowegis\Core\Definition\Asset\Assets;
use Cowegis\Core\Definition\Expression\Callbacks;
use Cowegis\Core\Provider\LayerData;
use Cowegis\Core\Definition\UI\Marker;
use IteratorAggregate;

final class MarkersLayerData implements LayerData, IteratorAggregate
{
    /** @var Marker[] */
    private $markers;

    /** @var Callbacks */
    private $callbacks;

    /** @var Assets */
    private $assets;

    public function __construct(array $markers, Assets $assets, Callbacks $callbacks)
    {
        $this->markers   = $markers;
        $this->callbacks = $callbacks;
        $this->assets    = $assets;
    }

    public function assets() : Assets
    {
        return $this->assets;
    }

    public function callbacks() : Callbacks
    {
        return $this->callbacks;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->markers);
    }
}
