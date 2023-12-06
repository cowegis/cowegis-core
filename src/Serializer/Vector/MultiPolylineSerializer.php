<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Vector\MultiPolyline;
use Cowegis\Core\Definition\Vector\Path;

use function assert;

/**
 * @extends CoordinatesBasedVectorSerializer<MultiPolyline>
 * @psalm-import-type TSerializedLatLngList from LatLngList
 */
final class MultiPolylineSerializer extends CoordinatesBasedVectorSerializer
{
    protected function serializedType(): string
    {
        return 'multiPolyline';
    }

    /** @return list<TSerializedLatLngList> */
    protected function serializeCoordinates(Path $layer): array
    {
        assert($layer instanceof MultiPolyline);

        $rings = [];

        foreach ($layer->getLatLngs() as $ring) {
            $rings[] = $ring->jsonSerialize();
        }

        return $rings;
    }
}
