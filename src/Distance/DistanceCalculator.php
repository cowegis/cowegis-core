<?php

declare(strict_types=1);

namespace Cowegis\Core\Distance;

use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Exception\UnsupportedDistanceAlgorithm;

/** @SuppressWarnings(PHPMD.ShortVariable) */
final class DistanceCalculator
{
    /** @var array<string, Algorithm> */
    private array $algorithms;

    /** @param array<string, Algorithm>|null $algorithms */
    public function __construct(array|null $algorithms = null)
    {
        $this->algorithms = $algorithms ?? [
            Algorithm::HARVESINE => new Harvesine(),
            Algorithm::VINCENTY => new Vincenty(),
        ];
    }

    public function calculate(LatLng $from, LatLng $to, string $algorithm = Algorithm::HARVESINE): float
    {
        if (! isset($this->algorithms[$algorithm])) {
            throw new UnsupportedDistanceAlgorithm('Unsupported distance algorithm: ' . $algorithm);
        }

        return $this->algorithms[$algorithm]->distance($from, $to);
    }
}
