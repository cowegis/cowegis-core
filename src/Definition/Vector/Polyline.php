<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Vector;

use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LatLngBounds;
use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\GeoJson\Geometry\LineString;
use Cowegis\GeoJson\Position\MultiCoordinates;

use function count;

final class Polyline extends PolylineObject
{
    private LatLngList $latLngs;

    private LatLngBounds|null $bounds = null;

    public function __construct(LayerId $layerId, string $name, LatLngList $latLngs, bool $initialVisible = true)
    {
        parent::__construct($layerId, $name, $initialVisible);

        $this->setLatLngs($latLngs);
    }

    public function getLatLngs(): LatLngList
    {
        return $this->latLngs;
    }

    public function setLatLngs(LatLngList $latLngs): self
    {
        $this->latLngs = $latLngs;
        $this->bounds  = null;

        return $this;
    }

    public function addLatLng(LatLng $latLng): self
    {
        $this->latLngs = $this->latLngs->add($latLng);
        $this->bounds  = null;

        return $this;
    }

    public function toGeoJson(): LineString
    {
        $coordinates = [];

        foreach ($this->latLngs as $latLng) {
            $coordinates[] = $latLng->toGeoJson();
        }

        return new LineString(new MultiCoordinates(...$coordinates));
    }

    public function isEmpty(): bool
    {
        return count($this->latLngs) === 0;
    }

    public function getBounds(): LatLngBounds
    {
        if ($this->bounds === null) {
            $this->bounds = $this->latLngs->bounds();
        }

        return $this->bounds;
    }
}
