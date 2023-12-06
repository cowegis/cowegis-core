<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoData;

use Cowegis\GeoJson\GeoJsonObject;

/**
 * This object contains GeoJSON data which
 */
final class InlineGeoJsonData implements GeoData
{
    public function __construct(private readonly GeoJsonObject $geoJsonObject)
    {
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        return [
            'type'   => 'inline',
            'format' => GeoData::FORMAT_GEOJSON,
            'data'   => $this->geoJsonObject->jsonSerialize(),
        ];
    }
}
