<?php

declare(strict_types=1);

namespace Cowegis\Core\Distance;

use Cowegis\Core\Definition\LatLng;
use Override;

/**
 * @see https://github.com/hofff/geo/blob/1.x/src/Calc/Vincenty.php
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
final class Vincenty implements DistanceAlgorithm
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

    #[Override]
    public function distance(LatLng $from, LatLng $to): float
    {
        $iterator = VincentyIterator::run($from, $to, $this->f);
        if (! $iterator instanceof VincentyIterator) {
            return 0.0;
        }

        $uSq = $iterator->cosSqAlpha * ($this->a * $this->a - $this->b * $this->b) / ($this->b * $this->b);
        $a   = 1.0 + $uSq / 16384.0 * (4096.0 + $uSq * (-768.0 + $uSq * (320.0 - 175.0 * $uSq)));
        $b   = $uSq / 1024.0 * (256.0 + $uSq * (-128.0 + $uSq * (74.0 - 47.0 * $uSq)));
        $c   = $iterator->cosSigma * (-1.0 + 2.0 * $iterator->cos2SigmaM * $iterator->cos2SigmaM);
        $d   = $b / 6.0 * $iterator->cos2SigmaM
            * (-3.0 + 4.0 * $iterator->sinSigma * $iterator->sinSigma)
            * (-3.0 + 4.0 * $iterator->cos2SigmaM * $iterator->cos2SigmaM);

        $deltaSigma = $b * $iterator->sinSigma * ($iterator->cos2SigmaM + $b / 4.0 * ($c - $d));

        return $this->b * $a * ($iterator->sigma - $deltaSigma);
    }
}
