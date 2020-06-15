<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\DataLayer;
use function assert;

final class DataLayerSerializer extends MapLayerSerializer
{
    public function serialize($layer) : array
    {
        assert($layer instanceof DataLayer);

        $data         = parent::serialize($layer);
        $data['type'] = 'data';
        $data['data'] = $layer->data();

        return $data;
    }
}
