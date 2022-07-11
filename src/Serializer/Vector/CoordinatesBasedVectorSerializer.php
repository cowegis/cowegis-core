<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\Vector\Path;
use Cowegis\Core\Exception\RuntimeException;
use Cowegis\Core\Serializer\Layer\MapLayerSerializer;

/**
 * @template T from Path
 * @extends MapLayerSerializer<T>
 */
abstract class CoordinatesBasedVectorSerializer extends MapLayerSerializer
{
    /**
     * {@inheritDoc}
     */
    public function serialize($layer): array
    {
        if (! $layer instanceof Path) {
            throw new RuntimeException('Unsupported layer type');
        }

        $data            = parent::serialize($layer);
        $data['type']    = $this->serializedType();
        $data['latlngs'] = $this->serializeCoordinates($layer);

        return $data;
    }

    abstract protected function serializedType(): string;

    /**
     * @psalm-param T $layer
     *
     * @return array<mixed>
     */
    abstract protected function serializeCoordinates(Path $layer): array;
}
