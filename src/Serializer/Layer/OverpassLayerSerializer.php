<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\OverpassLayer;
use function assert;

final class OverpassLayerSerializer extends MapLayerSerializer
{
    public function serialize($layer) : array
    {
        assert($layer instanceof OverpassLayer);

        $data         = parent::serialize($layer);
        $data['type'] = 'overpass';

        return $data;
    }
}
