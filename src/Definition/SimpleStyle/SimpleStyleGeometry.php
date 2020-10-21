<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\SimpleStyle;

/**
 * Interface SimpleStyleGeometry describes the geometry related part of the simplestyle-spec
 *
 * @see https://github.com/mapbox/simplestyle-spec/tree/master/1.1.0
 */
interface SimpleStyleGeometry
{
    /**
     * OPTIONAL: default "555555"
     * the color of a line as part of a polygon, polyline, or
     * multigeometry
     *
     * value must follow COLOR RULES
     */
    public function stroke(): ?string;

    /**
     * OPTIONAL: default 1.0
     * the opacity of the line component of a polygon, polyline, or
     * multigeometry
     *
     * value must be a floating point number greater than or equal to
     * zero and less or equal to than one
     */
    public function strokeOpacity(): ?float;

    /**
     *  OPTIONAL: default 2
     * the width of the line component of a polygon, polyline, or
     * multigeometry
     *
     * value must be a floating point number greater than or equal to 0
     */
    public function strokeWidth(): ?int;

    /**
     * OPTIONAL: default "555555"
     * the color of the interior of a polygon
     *
     * value must follow COLOR RULES
     */
    public function fill(): ?string;

    /**
     * OPTIONAL: default 0.6
     * the opacity of the interior of a polygon. Implementations
     * may choose to set this to 0 for line features.
     *
     * value must be a floating point number greater than or equal to
     * zero and less or equal to than one
     */
    public function fillOpacity(): ?float;
}
