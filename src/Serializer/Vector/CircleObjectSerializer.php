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
    public function serialize($layer): array
    {
        if (! $layer instanceof CircleObject) {
            throw new RuntimeException('Layer is not an instance of ' . CircleObject::class);
        }

        $data = parent::serialize($layer);

        $data['type']   = $this->serializedType();
        $data['center'] = $layer->center()->jsonSerialize();

        return $data;
    }

    abstract protected function serializedType(): string;
}
