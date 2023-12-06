<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\Layer;
use Cowegis\Core\Exception\RuntimeException;
use Cowegis\Core\Serializer\DataSerializer;

/**
 * @template T of Layer
 * @extends DataSerializer<T>
 */
abstract class MapLayerSerializer extends DataSerializer
{
    /**
     * @param T $data
     *
     * @return array<string,mixed>
     */
    public function serialize(mixed $data): array
    {
        if (! $data instanceof Layer) {
            throw new RuntimeException('Layer is not an instance of ' . Layer::class);
        }

        return [
            'layerId'        => $data->layerId()->value(),
            'name'           => $data->name(),
            'title'          => $data->title(),
            'initialVisible' => $data->initialVisible(),
            'options'        => $this->serializer->serialize($data->options()),
            'events'         => $this->serializer->serialize($data->events()),
        ];
    }
}
