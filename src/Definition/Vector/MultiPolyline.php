<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Vector;

use Cowegis\Core\Definition\LatLngBounds;
use Override;

use function array_merge;

final class MultiPolyline extends MultiPolylineObject
{
    #[Override]
    public function getBounds(): LatLngBounds
    {
        if (! $this->bounds instanceof LatLngBounds) {
            $coordinates = [];

            foreach ($this->getLatLngs() as $latLngList) {
                $coordinates[] = $latLngList->all();
            }

            $this->bounds = LatLngBounds::fromCoordinates(array_merge(...$coordinates));
        }

        return $this->bounds;
    }
}
