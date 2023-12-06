<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\TileLayer;
use Cowegis\Core\Exception\RuntimeException;

/** @extends MapLayerSerializer<TileLayer> */
final class TileLayerSerializer extends MapLayerSerializer
{
    /** @return array<string,mixed> */
    public function serialize(mixed $data): array
    {
        if (! $data instanceof TileLayer) {
            throw new RuntimeException('Unsupported layer type');
        }

        $serialized                = parent::serialize($data);
        $serialized['type']        = 'tileLayer';
        $serialized['urlTemplate'] = $data->urlTemplate();

        return $serialized;
    }
}
