<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider;

use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Map\Map;
use Cowegis\Core\Definition\Map\MapId;
use Cowegis\Core\Exception\DataNotFound;
use Cowegis\Core\Exception\MapNotFound;
use Cowegis\Core\IdFormat\DelegatingIdFormat;
use Cowegis\Core\IdFormat\IdFormat;

final class DelegatingProvider implements Provider
{
    /** @var Provider[] */
    private $providers;

    /**
     * @param Provider[] $providers
     */
    public function __construct(iterable $providers)
    {
        $this->providers = $providers;
    }

    public function idFormat(): IdFormat
    {
        /** @var IdFormat|null $idFormat */
        static $idFormat;

        if ($idFormat === null) {
            $idFormats = [];
            foreach ($this->providers as $provider) {
                $idFormats[] = $provider->idFormat();
            }
            $idFormat = new DelegatingIdFormat($idFormats);
        }

        return $idFormat;
    }

    public function findMap(MapId $mapId, Context $context): Map
    {
        foreach ($this->providers as $provider) {
            try {
                return $provider->findMap($mapId, $context);
            } catch (MapNotFound $exception) {
                // Do nothing try next provider
            }
        }

        throw MapNotFound::withMapId($mapId);
    }

    public function findLayerData(MapId $mapId, LayerId $layerId, Context $context): LayerData
    {
        foreach ($this->providers as $provider) {
            try {
                return $provider->findLayerData($mapId, $layerId, $context);
            } catch (DataNotFound $exception) {
                // Try next provider
            }
        }

        throw DataNotFound::forLayer($layerId, $mapId);
    }
}
