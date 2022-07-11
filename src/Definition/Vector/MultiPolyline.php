<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Vector;

use Cowegis\Core\Definition\LatLngBounds;

use function array_merge;

final class MultiPolyline extends MultiPolylineObject
{
    public function getBounds(): LatLngBounds
    {
        if ($this->bounds === null) {
            $coordinates = [];

            foreach ($this->getLatLngs() as $latLngList) {
                $coordinates[] = $latLngList->all();
            }

            $this->bounds = LatLngBounds::fromCoordinates(array_merge(...$coordinates));
        }

        return $this->bounds;
    }
}
