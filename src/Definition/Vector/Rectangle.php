<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Vector;

use Cowegis\Core\Definition\LatLngBounds;
use Cowegis\Core\Definition\Layer\LayerId;

final class Rectangle extends Path
{
    public function __construct(
        LayerId $layerId,
        string $name,
        private readonly LatLngBounds $bounds,
        bool $initialVisible = true,
    ) {
        parent::__construct($layerId, $name, $initialVisible);
    }

    public function bounds(): LatLngBounds
    {
        return $this->bounds;
    }
}
