<?php

declare(strict_types=1);

namespace Cowegis\Core\Distance;

use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LatLngBounds;
use Cowegis\Core\Exception\UnsupportedDistanceAlgorithm;

/** @SuppressWarnings(PHPMD.ShortVariable) */
final class Calculator
{
    /** @var array<string, DistanceAlgorithm|BoundsOfCircleAlgorithm> */
    private array $algorithms;

    /** @param array<string, DistanceAlgorithm>|null $algorithms */
    public function __construct(array|null $algorithms = null)
    {
        $this->algorithms = $algorithms ?? [
            DistanceAlgorithm::HARVESINE => new Harvesine(),
            DistanceAlgorithm::VINCENTY  => new Vincenty(),
            DistanceAlgorithm::RHUMB => new Rhumb(),
        ];
    }

    public function distance(LatLng $from, LatLng $to, string $algorithm = DistanceAlgorithm::HARVESINE): float
    {
        if (! isset($this->algorithms[$algorithm]) || ! $this->algorithms[$algorithm] instanceof DistanceAlgorithm) {
            throw new UnsupportedDistanceAlgorithm('Unsupported distance algorithm: ' . $algorithm);
        }

        return $this->algorithms[$algorithm]->distance($from, $to);
    }

    public function boundsOfCircle(
        LatLng $center,
        float $radius,
        string $algorithm = DistanceAlgorithm::RHUMB,
    ): LatLngBounds {
        if (
            ! isset($this->algorithms[$algorithm])
            || ! $this->algorithms[$algorithm] instanceof BoundsOfCircleAlgorithm
        ) {
            throw new UnsupportedDistanceAlgorithm('Unsupported distance algorithm: ' . $algorithm);
        }

        return $this->algorithms[$algorithm]->boundsOfCircle($center, $radius);
    }
}
