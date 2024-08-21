<?php

declare(strict_types=1);

namespace Cowegis\Core\Distance;

use Cowegis\Core\Definition\LatLng;

/** @SuppressWarnings(PHPMD.ShortVariable) */
interface DistanceAlgorithm
{
    public const HARVESINE = 'harvesine';

    public const VINCENTY = 'vincenty';

    public const RHUMB = 'rhumb';

    public function distance(LatLng $from, LatLng $to): float;
}
