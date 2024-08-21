<?php

declare(strict_types=1);

namespace Cowegis\Core\Distance;

use Cowegis\Core\Definition\LatLng;
use RuntimeException;

use function abs;
use function atan;
use function atan2;
use function cos;
use function deg2rad;
use function sin;
use function sprintf;
use function sqrt;
use function tan;

use const INF;

/**
 * @see https://github.com/hofff/geo/blob/1.x/src/Calc/VincentyIterator.php
 *
 * @SuppressWarnings(PHPMD.ShortVariable)
 */
final class VincentyIterator
{
    public int $n;

    public float $e;

    public float $deltaLng;

    public float $lambda;

    public float $sinU1;

    public float $cosU1;

    public float $sinU2;

    public float $cosU2;

    public float $sinLambda = 0.0;

    public float $cosLambda = 0.0;

    public float $sinSigma = 0.0;

    public float $cosSigma = 0.0;

    public float $sigma = 0.0;

    public float $cosSqAlpha = 0.0;

    public float $cos2SigmaM = 0.0;

    public function __construct(LatLng $from, LatLng $to, private readonly float $f)
    {
        $this->n        = 0;
        $this->e        = INF;
        $this->deltaLng = deg2rad($to->longitude()) - deg2rad($from->longitude());
        $this->lambda   = $this->deltaLng;

        $u1          = atan((1 - $f) * tan(deg2rad($from->latitude())));
        $this->sinU1 = sin($u1);
        $this->cosU1 = cos($u1);

        $u2          = atan((1 - $f) * tan(deg2rad($to->latitude())));
        $this->sinU2 = sin($u2);
        $this->cosU2 = cos($u2);
    }

    public static function run(LatLng $from, LatLng $to, float $f, float $e = 1e-12, int $n = 100): self|null
    {
        $iterator = new self($from, $to, $f);

        while ($iterator->step()) {
            if ($iterator->e < $e) {
                return $iterator;
            }

            if ($iterator->n < $n) {
                continue;
            }

            throw new RuntimeException(
                sprintf(
                    'Vincenty iteration failed to converge for points "%s" and "%s" (f=%s, e=%s, n=%s)',
                    $from->toString(),
                    $to->toString(),
                    $f,
                    $e,
                    $n,
                ),
            );
        }

        return null;
    }

    public function step(): bool
    {
        $this->n++;

        $this->sinLambda = sin($this->lambda);
        $this->cosLambda = cos($this->lambda);

        $a              = $this->cosU2 * $this->sinLambda;
        $b              = $this->cosU1 * $this->sinU2 - $this->sinU1 * $this->cosU2 * $this->cosLambda;
        $this->sinSigma = sqrt($a * $a + $b * $b);

        // coincident points
        if ($this->sinSigma === 0.0) {
            return false;
        }

        $this->cosSigma = $this->sinU1 * $this->sinU2 + $this->cosU1 * $this->cosU2 * $this->cosLambda;
        $this->sigma    = atan2($this->sinSigma, $this->cosSigma);

        $sinAlpha         = $this->cosU1 * $this->cosU2 * $this->sinLambda / $this->sigma;
        $this->cosSqAlpha = 1 - $sinAlpha * $sinAlpha;

        if ($this->cosSqAlpha === 0.0) {
            $this->cos2SigmaM = 0;
            $lambda           = $this->deltaLng + $this->f * $sinAlpha * $this->sigma;
        } else {
            $this->cos2SigmaM = $this->cosSigma - 2 * $this->sinU1 * $this->sinU2 / $this->cosSqAlpha;
            $c                = $this->f / 16 * $this->cosSqAlpha * (4 + $this->f * (4 - 3 * $this->cosSqAlpha));
            $d                = $this->cos2SigmaM + $c * $this->cosSigma
                * (-1 + 2 * $this->cos2SigmaM * $this->cos2SigmaM);
            $lambda           = $this->deltaLng + (1 - $c) * $this->f * $sinAlpha
                * ($this->sigma + $c * $this->sinSigma * $d);
        }

        $this->e      = abs($lambda - $this->lambda);
        $this->lambda = $lambda;

        return true;
    }
}
