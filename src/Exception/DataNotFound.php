<?php

declare(strict_types=1);

namespace Cowegis\Core\Exception;

use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Map\MapId;

use function sprintf;

final class DataNotFound extends RuntimeException
{
    public static function forLayer(LayerId $layerId, MapId|null $mapId): self
    {
        if ($mapId) {
            return new self(
                sprintf(
                    'Layer data (ID %s) for map (ID %s) not found',
                    $layerId->value(),
                    $mapId->value(),
                ),
            );
        }

        return new self(sprintf('Layer data (ID %s) not found', $layerId->value()));
    }
}
