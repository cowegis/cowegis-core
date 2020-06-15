<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Layer\LayerIds;
use Cowegis\Core\Serializer\Serializer;
use function array_map;

final class LayerIdsSerializer implements Serializer
{
    public function serialize($layerIds) : array
    {
        assert($layerIds instanceof LayerIds);

        return array_map(
            static function (LayerId $layerId) {
                return $layerId->value();
            },
            $layerIds->toArray()
        );
    }
}
