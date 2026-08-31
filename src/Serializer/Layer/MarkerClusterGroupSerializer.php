<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Override;

final class MarkerClusterGroupSerializer extends LayerGroupSerializer
{
    #[Override]
    protected function type(): string
    {
        return 'markerClusterGroup';
    }
}
