<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider;

use Cowegis\Core\Definition\Asset\Assets;
use Cowegis\Core\Definition\Expression\Callbacks;
use Cowegis\Core\Definition\Map\MapId;
use Cowegis\Core\Filter\Filter;

final class ProviderContext extends RootContext
{
    public static function create(Filter $filter, MapId $mapId, string $locale): self
    {
        return new self(
            new Callbacks(static::createIdentifier($mapId)),
            new Assets(),
            $filter,
            $mapId,
            $locale,
        );
    }

    private static function createIdentifier(MapId $mapId): string
    {
        return 'map_' . $mapId->value();
    }
}
