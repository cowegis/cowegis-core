<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Definition\Map\Map;

interface MapObject
{
    public function addTo(Map $map): void;
}
