<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Vector;

use Assert\Assertion;
use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\GeoJson\Geometry\MultiPolygon as GeoJsonMultiPolygon;
use Cowegis\GeoJson\Position\LinearRing;

final class MultiPolygon extends Path
{
    /** @var list<list<LatLngList>> */
    private array $latLngs;

    /** @param list<list<LatLngList>> $latLngs */
    public function __construct(LayerId $layerId, string $name, array $latLngs, bool $initialVisible = true)
    {
        parent::__construct($layerId, $name, $initialVisible);

        $this->latLngs = $latLngs;
    }

    /** @param list<list<LatLngList>> $latLngs */
    public function setLatLngs(array $latLngs): void
    {
        foreach ($latLngs as $lists) {
            Assertion::allIsInstanceOf($lists, LatLngList::class);
        }

        $this->latLngs = $latLngs;
    }

    /** @return list<list<LatLngList>> */
    public function getLatLngs(): array
    {
        return $this->latLngs;
    }

    public function toGeoJson(): GeoJsonMultiPolygon
    {
        $linearRings = [];

        foreach ($this->latLngs as $latLngs) {
            $rings = [];

            foreach ($latLngs as $latLngList) {
                $list = [];

                foreach ($latLngList as $coordinate) {
                    $list[] = $coordinate->toGeoJson();
                }

                $rings[] = new LinearRing(...$list);
            }

            $linearRings[] = $rings;
        }

        return new GeoJsonMultiPolygon($linearRings);
    }
}
