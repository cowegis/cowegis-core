<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Vector;

use Cowegis\Core\Definition\LatLngBounds;

final class Polygon extends MultiPolylineObject
{
    public function getBounds(): LatLngBounds
    {
        if ($this->bounds === null) {
            $latLngs = $this->getLatLngs();
            $latLngs = isset($latLngs[0]) ? $latLngs[0]->all() : [];

            $this->bounds = LatLngBounds::fromCoordinates($latLngs);
        }

        return $this->bounds;
    }
}
