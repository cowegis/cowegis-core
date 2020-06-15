<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\SimpleStyle;

/**
 * Interface SimpleStyleContent describes the content related part of the simplestyle-spec
 *
 * @see https://github.com/mapbox/simplestyle-spec/tree/master/1.1.0
 */
interface SimpleStyleContent
{
    // OPTIONAL: default ""
    // A title to show when this item is clicked or
    // hovered over
    public function title() : ?string;

    // OPTIONAL: default ""
    // A description to show when this item is clicked or
    // hovered over
    public function description() : ?string;
}
