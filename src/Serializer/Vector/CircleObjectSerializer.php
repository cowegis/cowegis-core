<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\Vector\CircleObject;
use Cowegis\Core\Exception\RuntimeException;
use Cowegis\Core\Serializer\Layer\MapLayerSerializer;

/** @extends MapLayerSerializer<CircleObject> */
abstract class CircleObjectSerializer extends MapLayerSerializer
{
    /** {@inheritDoc} */
    public function serialize(mixed $data): array
    {
        if (! $data instanceof CircleObject) {
            throw new RuntimeException('Layer is not an instance of ' . CircleObject::class);
        }

        $serialized = parent::serialize($data);

        $serialized['type']   = $this->serializedType();
        $serialized['center'] = $data->center()->jsonSerialize();

        return $serialized;
    }

    abstract protected function serializedType(): string;
}
