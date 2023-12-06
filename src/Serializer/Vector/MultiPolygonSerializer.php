<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Vector\MultiPolygon;
use Cowegis\Core\Definition\Vector\Path;

use function assert;

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
        assert($layer instanceof MultiPolygon);

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
