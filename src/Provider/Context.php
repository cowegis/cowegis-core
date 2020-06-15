<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider;

use Cowegis\Core\Definition\Asset\Assets;
use Cowegis\Core\Definition\Expression\Callbacks;
use Cowegis\Core\Definition\Map\MapId;
use Cowegis\Core\Filter\Filter;

interface Context
{
    public function mapId() : MapId;

    public function assets() : Assets;

    public function callbacks() : Callbacks;

    public function filter() : Filter;

    public function locale() : string;
}
