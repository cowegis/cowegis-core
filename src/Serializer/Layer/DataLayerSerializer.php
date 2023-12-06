<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\DataLayer;

/** @extends MapLayerSerializer<DataLayer> */
final class DataLayerSerializer extends MapLayerSerializer
{
    /** {@inheritDoc}*/
    public function serialize(mixed $data): array
    {
        $serialized         = parent::serialize($data);
        $serialized['type'] = 'data';
        $serialized['data'] = $data->data();

        return $serialized;
    }
}
