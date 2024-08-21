<?php

declare(strict_types=1);

namespace Cowegis\Core\Distance;

use Cowegis\Core\Definition\LatLng;

use function atan2;
use function cos;
use function deg2rad;
use function sin;
use function sqrt;

/**
 * @see https://github.com/hofff/geo/blob/1.x/src/Calc/Haversine.php
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
final class Harvesine implements DistanceAlgorithm
{
    public const EARTH_RADIUS = 6371000.0;

    public function __construct(public readonly float $earthRadius = self::EARTH_RADIUS)
    {
    }

    public function distance(LatLng $from, LatLng $to): float
    {
        $fromLat  = deg2rad($from->latitude());
        $toLat    = deg2rad($to->latitude());
        $deltaLat = $toLat - $fromLat;
        $deltaLng = deg2rad($to->longitude()) - deg2rad($from->longitude());

        $a = sin($deltaLat / 2);
        $b = sin($deltaLng / 2);
        $c = $a * $a + $b * $b * cos($fromLat) * cos($toLat);
        $d = 2 * atan2(sqrt($c), sqrt(1 - $c));

        return $d * $this->earthRadius;
    }
}
