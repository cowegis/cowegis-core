<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\Layer;
use Cowegis\Core\Exception\RuntimeException;
use Cowegis\Core\Serializer\DataSerializer;

abstract class MapLayerSerializer extends DataSerializer
{
    public function serialize($layer) : array
    {
        if (! $layer instanceof Layer) {
            throw new RuntimeException('Layer is not an instance of ' . Layer::class);
        }

        return [
            'layerId'        => $layer->layerId()->value(),
            'name'           => $layer->name(),
            'title'          => $layer->title(),
            'initialVisible' => $layer->initialVisible(),
            'options'        => $this->serializer->serialize($layer->options()),
            'events'         => $this->serializer->serialize($layer->events()),
        ];
    }
}
