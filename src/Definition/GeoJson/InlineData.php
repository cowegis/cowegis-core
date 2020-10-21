<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoJson;

use Cowegis\GeoJson\GeoJsonObject;

final class InlineData implements GeoJsonData
{
    /** @var GeoJsonObject */
    private $geoJsonObject;

    public function __construct(GeoJsonObject $geoJsonObject)
    {
        $this->geoJsonObject = $geoJsonObject;
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        return [
            'type'   => 'internal',
            'format' => 'geojson',
            'data'   => $this->geoJsonObject,
        ];
    }
}
