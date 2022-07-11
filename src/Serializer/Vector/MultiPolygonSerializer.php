<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Vector\MultiPolygon;
use Cowegis\Core\Definition\Vector\Path;

/**
 * @extends CoordinatesBasedVectorSerializer<MultiPolygon>
 * @psalm-import-type TSerializedLatLngList from LatLngList
 */
final class MultiPolygonSerializer extends CoordinatesBasedVectorSerializer
{
    protected function serializedType(): string
    {
        return 'multiPolygon';
    }

    /** @return list<list<TSerializedLatLngList>> */
    protected function serializeCoordinates(Path $layer): array
    {
        $serialized = [];

        foreach ($layer->getLatLngs() as $rings) {
            $data = [];

            foreach ($rings as $latLngs) {
                $data[] = $latLngs->jsonSerialize();
            }

            $serialized[] = $data;
        }

        return $serialized;
    }
}
