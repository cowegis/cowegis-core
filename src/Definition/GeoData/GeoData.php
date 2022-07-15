<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoData;

use JsonSerializable;

/**
 * This interface describes geo data which can be presented by a data layer.
 */
interface GeoData extends JsonSerializable
{
    public const FORMAT_GEOJSON  = 'geojson';
    public const FORMAT_TOPOJSON = 'topojson';
    public const FORMAT_GPX      = 'gpx';
    public const FORMAT_WKT      = 'wkt';
    public const FORMAT_KML      = 'kml';
}
