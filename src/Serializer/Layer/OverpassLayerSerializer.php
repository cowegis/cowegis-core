<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\OverpassLayer;

/** @extends MapLayerSerializer<OverpassLayer> */
final class OverpassLayerSerializer extends MapLayerSerializer
{
    /** {@inheritDoc} */
    public function serialize(mixed $data): array
    {
        $serialized         = parent::serialize($data);
        $serialized['type'] = 'overpass';

        return $serialized;
    }
}
