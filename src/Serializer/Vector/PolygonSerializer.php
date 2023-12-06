<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Vector\Path;
use Cowegis\Core\Definition\Vector\Polygon;

use function assert;

/**
 * @extends CoordinatesBasedVectorSerializer<Polygon>
 * @psalm-import-type TSerializedLatLngList from LatLngList
 */
final class PolygonSerializer extends CoordinatesBasedVectorSerializer
{
    protected function serializedType(): string
    {
        return 'polygon';
    }

    /** @return list<TSerializedLatLngList> */
    protected function serializeCoordinates(Path $layer): array
    {
        assert($layer instanceof Polygon);

        $serialized = [];

        foreach ($layer->getLatLngs() as $latLngs) {
            $serialized[] = $latLngs->jsonSerialize();
        }

        return $serialized;
    }
}
