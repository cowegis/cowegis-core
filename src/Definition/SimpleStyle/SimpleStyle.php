<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\SimpleStyle;

/**
 * Interface SimpleStyle describes the simplestyle-spec
 *
 * @see https://github.com/mapbox/simplestyle-spec/tree/master/1.1.0
 */
interface SimpleStyle extends SimpleStyleContent, SimpleStyleGeometry, SimpleStyleMarker
{
}
