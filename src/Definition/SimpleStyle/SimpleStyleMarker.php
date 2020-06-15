<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\SimpleStyle;

/**
 * Interface SimpleStyleMarker describes the marker related part of the simplestyle-spec
 *
 * @see https://github.com/mapbox/simplestyle-spec/tree/master/1.1.0
 */
interface SimpleStyleMarker
{
    /**
     * OPTIONAL: default "medium"
     * specify the size of the marker. sizes
     * can be different pixel sizes in different
     * implementations
     * Value must be one of
     * "small"
     * "medium"
     * "large"*/
    public function markerSize() : ?string;

    /**
     * OPTIONAL: default ""
     * a symbol to position in the center of this icon
     * if not provided or "", no symbol is overlaid
     * and only the marker is shown
     * Allowed values include
     * - Icon ID
     * - An integer 0 through 9
     * - A lowercase character "a" through "z"
     */
    public function markerSymbol();

    /**
     * OPTIONAL: default "7e7e7e"
     * the marker's color
     *
     * value must follow COLOR RULES*/
    public function markerColor() : ?string;

    /**
     * OPTIONAL: default "ffffff"
     * the marker's symbol color
     *
     * value must follow COLOR RULES
     */
    public function symbolColor() :?string;
}
