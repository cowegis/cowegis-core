<?php

declare(strict_types=1);

namespace Cowegis\Core\Exception;

use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Map\MapId;

use function sprintf;

final class LayerNotFound extends RuntimeException
{
    public static function withLayerId(LayerId $layerId, MapId|null $mapId): self
    {
        if ($mapId instanceof MapId) {
            return new self(
                sprintf(
                    'Layer (ID %s) for map (ID %s) not found',
                    $layerId->value(),
                    $mapId->value(),
                ),
            );
        }

        return new self(sprintf('Layer (ID %s) not found', $layerId->value()));
    }
}
