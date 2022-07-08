<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter\Rule;

use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Filter\Query;
use Cowegis\Core\Filter\Rule;

final class DistanceRule implements Rule
{
    public const QUERY_PARAM = 'distance';

    private LatLng $coordinates;

    /**
     * The radius in meter.
     */
    private int $radius;

    /**
     * @param LatLng $latLng The center point.
     * @param int    $radius The radius in meter.
     */
    public function __construct(LatLng $latLng, int $radius)
    {
        $this->coordinates = $latLng;
        $this->radius      = $radius;
    }

    public function name(): string
    {
        return self::QUERY_PARAM;
    }

    public function coordinates(): LatLng
    {
        return $this->coordinates;
    }

    /**
     * Get the radius in meter.
     */
    public function radius(): int
    {
        return $this->radius;
    }

    public function toQuery(Query $query): Query
    {
        return $query->with(
            $this->name(),
            [
                'coordinates' => $this->coordinates()->toString(),
                'radius'      => (string) $this->radius(),
            ]
        );
    }
}
