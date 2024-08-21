<?php

declare(strict_types=1);

namespace Cowegis\Core\Distance;

use Cowegis\Core\Definition\LatLng;

/** @SuppressWarnings(PHPMD.ShortVariable) */
interface Algorithm
{
    public const HARVESINE = 'harvesine';

    public const VINCENTY = 'vincenty';

    public function distance(LatLng $from, LatLng $to): float;
}
