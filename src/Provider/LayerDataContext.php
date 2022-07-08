<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider;

use Cowegis\Core\Definition\Asset\Assets;
use Cowegis\Core\Definition\Expression\Callbacks;
use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Map\MapId;
use Cowegis\Core\Filter\Filter;

final class LayerDataContext extends RootContext
{
    private LayerId $layerId;

    public function __construct(
        Callbacks $callbacks,
        Assets $assets,
        Filter $filter,
        MapId $mapId,
        LayerId $layerId,
        string $locale
    ) {
        parent::__construct($callbacks, $assets, $filter, $mapId, $locale);

        $this->layerId = $layerId;
    }

    public static function create(Filter $filter, MapId $mapId, LayerId $layerId, string $locale): self
    {
        return new self(
            new Callbacks(static::createIdentifier($layerId)),
            new Assets(),
            $filter,
            $mapId,
            $layerId,
            $locale
        );
    }

    private static function createIdentifier(LayerId $layerId): string
    {
        return 'layer_' . $layerId->value();
    }

    public function layerId(): LayerId
    {
        return $this->layerId;
    }
}
