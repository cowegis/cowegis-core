<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Vector;

use Cowegis\Core\Definition\LatLngBounds;
use Cowegis\Core\Definition\Layer\LayerId;

final class Rectangle extends Path
{
    private LatLngBounds $bounds;

    public function __construct(LayerId $layerId, string $name, LatLngBounds $bounds, bool $initialVisible = true)
    {
        parent::__construct($layerId, $name, $initialVisible);

        $this->bounds = $bounds;
    }

    public function bounds(): LatLngBounds
    {
        return $this->bounds;
    }
}
