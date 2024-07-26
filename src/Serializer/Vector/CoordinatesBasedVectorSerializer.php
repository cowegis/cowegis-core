<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\Vector\Path;
use Cowegis\Core\Exception\RuntimeException;
use Cowegis\Core\Serializer\Layer\MapLayerSerializer;

/**
 * @template T of Path
 * @extends MapLayerSerializer<T>
 */
abstract class CoordinatesBasedVectorSerializer extends MapLayerSerializer
{
    /** {@inheritDoc}*/
    public function serialize(mixed $data): array
    {
        if (! $data instanceof Path) {
            throw new RuntimeException('Unsupported layer type');
        }

        $serialized            = parent::serialize($data);
        $serialized['type']    = $this->serializedType();
        $serialized['latlngs'] = $this->serializeCoordinates($data);

        return $serialized;
    }

    abstract protected function serializedType(): string;

    /**
     * @psalm-param T $layer
     *
     * @return array<mixed>
     */
    abstract protected function serializeCoordinates(Path $layer): array;
}
