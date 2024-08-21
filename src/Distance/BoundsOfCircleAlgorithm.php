<?php

declare(strict_types=1);

namespace Cowegis\Core\Distance;

use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LatLngBounds;

interface BoundsOfCircleAlgorithm
{
    public function boundsOfCircle(LatLng $center, float $radius): LatLngBounds;
}
