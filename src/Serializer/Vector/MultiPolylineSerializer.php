<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Vector\MultiPolyline;
use Cowegis\Core\Definition\Vector\Path;
use Override;

/**
 * @extends CoordinatesBasedVectorSerializer<MultiPolyline>
 * @psalm-import-type TSerializedLatLngList from LatLngList
 */
final class MultiPolylineSerializer extends CoordinatesBasedVectorSerializer
{
    #[Override]
    protected function serializedType(): string
    {
        return 'multiPolyline';
    }

    /**
     * @param MultiPolyline $layer
     *
     * @return list<TSerializedLatLngList>
     */
    #[Override]
    protected function serializeCoordinates(Path $layer): array
    {
        $rings = [];

        foreach ($layer->getLatLngs() as $ring) {
            $rings[] = $ring->jsonSerialize();
        }

        return $rings;
    }
}
