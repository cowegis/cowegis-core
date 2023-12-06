<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Vector\Path;
use Cowegis\Core\Definition\Vector\Polyline;

use function assert;

/**
 * @extends CoordinatesBasedVectorSerializer<Polyline>
 * @psalm-import-type TSerializedLatLngList from LatLngList
 */
final class PolylineSerializer extends CoordinatesBasedVectorSerializer
{
    protected function serializedType(): string
    {
        return 'polyline';
    }

    /** @return TSerializedLatLngList */
    protected function serializeCoordinates(Path $layer): array
    {
        assert($layer instanceof Polyline);

        return $layer->getLatLngs()->jsonSerialize();
    }
}
