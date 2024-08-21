<?php

declare(strict_types=1);

namespace Cowegis\Core\Distance;

use Cowegis\Core\Definition\LatLng;

/**
 * @see https://github.com/hofff/geo/blob/1.x/src/Calc/Vincenty.php
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
final class Vincenty implements Algorithm
{
    public const A = 6378137.0;

    public const B = 6356752.314245;

    public const FR = 298.257223563;

    public function __construct(
        private readonly float $a = self::A,
        private readonly float $b = self::B,
        private readonly float $f = self::FR,
    ) {
    }

    public function distance(LatLng $from, LatLng $to): float
    {
        $iterator = VincentyIterator::run($from, $to, $this->f);
        if (! $iterator instanceof VincentyIterator) {
            return 0.0;
        }

        $uSq = $iterator->cosSqAlpha * ($this->a * $this->a - $this->b * $this->b) / ($this->b * $this->b);
        $a   = 1 + $uSq / 16384 * (4096 + $uSq * (-768 + $uSq * (320 - 175 * $uSq)));
        $b   = $uSq / 1024 * (256 + $uSq * (-128 + $uSq * (74 - 47 * $uSq)));
        $c   = $iterator->cosSigma * (-1 + 2 * $iterator->cos2SigmaM * $iterator->cos2SigmaM);
        $d   = $b / 6 * $iterator->cos2SigmaM
            * (-3 + 4 * $iterator->sinSigma * $iterator->sinSigma)
            * (-3 + 4 * $iterator->cos2SigmaM * $iterator->cos2SigmaM);

        $deltaSigma = $b * $iterator->sinSigma * ($iterator->cos2SigmaM + $b / 4 * ($c - $d));

        return $this->b * $a * ($iterator->sigma - $deltaSigma);
    }
}
