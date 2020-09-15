<?php

declare(strict_types=1);

namespace Cowegis\Core\Exception;

use Cowegis\Core\Definition\Map\MapId;

final class MapNotFound extends RuntimeException
{
    public static function withMapId(MapId $mapId) : self
    {
        return new self(sprintf('Map (ID %s) not found', $mapId->value()));
    }
}
