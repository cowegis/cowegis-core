<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

class LayerGroup extends Layer
{
    private LayerIds $layers;

    public function __construct(LayerId $layerId, string $name, bool $initialVisible)
    {
        parent::__construct($layerId, $name, $initialVisible);

        $this->layers = new LayerIds();
    }

    public function layers(): LayerIds
    {
        return $this->layers;
    }
}
