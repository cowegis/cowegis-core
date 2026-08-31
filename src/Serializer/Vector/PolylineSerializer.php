<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Vector\Path;
use Cowegis\Core\Definition\Vector\Polyline;
use Override;

/**
 * @extends CoordinatesBasedVectorSerializer<Polyline>
 * @psalm-import-type TSerializedLatLngList from LatLngList
 */
final class PolylineSerializer extends CoordinatesBasedVectorSerializer
{
    #[Override]
    protected function serializedType(): string
    {
        return 'polyline';
    }

    /**
     * @param Polyline $layer
     *
     * @return TSerializedLatLngList
     */
    #[Override]
    protected function serializeCoordinates(Path $layer): array
    {
        return $layer->getLatLngs()->jsonSerialize();
    }
}
