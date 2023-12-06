<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use Cowegis\Core\Definition\Event\EventsPlugin;
use Cowegis\Core\Definition\HasEvents;
use Cowegis\Core\Definition\HasName;
use Cowegis\Core\Definition\HasTitle;
use Cowegis\Core\Definition\LayerObject;
use Cowegis\Core\Definition\Map\Map;
use Cowegis\Core\Definition\NamePlugin;
use Cowegis\Core\Definition\TitlePlugin;

abstract class Layer extends LayerObject implements HasTitle, HasName, HasEvents
{
    use EventsPlugin;
    use NamePlugin;
    use TitlePlugin;

    public function __construct(
        private readonly LayerId $layerId,
        string $name,
        private readonly bool $initialVisible = true,
    ) {
        $this->name = $name;
    }

    public function addTo(Map $map): void
    {
        $map->layers()->add($this);
    }

    public function layerId(): LayerId
    {
        return $this->layerId;
    }

    public function initialVisible(): bool
    {
        return $this->initialVisible;
    }
}
