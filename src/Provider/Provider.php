<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider;

use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Map\Map;
use Cowegis\Core\Definition\Map\MapId;
use Cowegis\Core\IdFormat\IdFormat;

interface Provider
{
    public function idFormat() : IdFormat;

    public function findMap(MapId $mapId, Context $context) : Map;

    public function findLayerData(MapId $mapId, LayerId $layerId, Context $context) : LayerData;
}
