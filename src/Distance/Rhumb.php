<?php

declare(strict_types=1);

namespace Cowegis\Core\Distance;

use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LatLngBounds;

use function abs;
use function cos;
use function deg2rad;
use function fmod;
use function log;
use function pi;
use function rad2deg;
use function sin;
use function sqrt;
use function tan;

/**
 * @see https://github.com/hofff/geo/blob/1.x/src/Calc/Rhumb.php
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
final class Rhumb implements DistanceAlgorithm, BoundsOfCircleAlgorithm
{
    public const EARTH_RADIUS = 6371000.0;

    public function __construct(public readonly float $earthRadius = self::EARTH_RADIUS)
    {
    }

    public function distance(LatLng $from, LatLng $to): float
    {
        $pi       = pi();
        $fromLat  = deg2rad($from->latitude());
        $toLat    = deg2rad($to->latitude());
        $deltaLat = $toLat - $fromLat;
        $deltaLng = abs(deg2rad($to->longitude()) - deg2rad($from->longitude()));

        if ($deltaLng > $pi) {
            $deltaLng = 2 * $pi - $deltaLng;
        }

        $deltaPhi = $this->calculateDeltaPhi($fromLat, $toLat);

        // E-W line gives $deltaPhi = 0
        $q = $deltaPhi !== 0.0 ? $deltaLat / $deltaPhi : cos($fromLat);

        return sqrt($deltaLat * $deltaLat + $q * $q * $deltaLng * $deltaLng) * $this->earthRadius;
    }

    public function boundsOfCircle(LatLng $center, float $radius): LatLngBounds
    {
        if ($radius <= 0) {
            return new LatLngBounds($center, $center);
        }

        $radius = sqrt(2 * $radius * $radius);
        $sw     = $this->destination($center, 225.0, $radius);
        $ne     = $this->destination($center, 45.0, $radius);

        return new LatLngBounds($sw, $ne);
    }

    private function calculateDeltaPhi(float $fromLat, float $toLat): float
    {
        return log(tan($toLat / 2 + pi() / 4) / tan($fromLat / 2 + pi() / 4));
    }

    private function destination(LatLng $from, float $bearing, float $distance): LatLng
    {
        $pi        = pi();
        $fromLat   = deg2rad($from->latitude());
        $distance /= $this->earthRadius;
        $bearing   = deg2rad($bearing);

        $toLat    = $fromLat + $distance * cos($bearing);
        $deltaLat = $toLat - $fromLat;
        $deltaPhi = $this->calculateDeltaPhi($fromLat, $toLat);
        $q        = $deltaPhi !== 0.0 ? $deltaLat / $deltaPhi : cos($fromLat);
        $deltaLng = $distance * sin($bearing) / $q;

        abs($toLat) > $pi / 2 && $toLat = ($toLat > 0 ? -1 : 1) * ($pi - $toLat);

        $toLng = fmod(deg2rad($from->longitude()) + $deltaLng + 3 * $pi, 2 * $pi) - $pi;

        return new LatLng(rad2deg($toLat), rad2deg($toLng));
    }
}
