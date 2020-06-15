<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

final class MarkerClusterGroupSerializer extends LayerGroupSerializer
{
    protected function type() : string
    {
        return 'markerClusterGroup';
    }
}
