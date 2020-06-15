<?php

declare(strict_types=1);

namespace Cowegis\Core\Exception;

use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Map\MapId;

final class DataNotFound extends RuntimeException
{
    public static function forLayer(LayerId $layerId, ?MapId $mapId) : self
    {
        // TODO: Implement
        return new self();
    }
}
