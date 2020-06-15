<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use Cowegis\Core\Definition\Event\EventsPlugin;
use Cowegis\Core\Definition\HasEvents;
use Cowegis\Core\Definition\HasName;
use Cowegis\Core\Definition\HasTitle;
use Cowegis\Core\Definition\NamePlugin;
use Cowegis\Core\Definition\TitlePlugin;
use Cowegis\Core\Definition\LayerObject;

abstract class Layer extends LayerObject implements HasTitle, HasName, HasEvents
{
    use EventsPlugin;
    use NamePlugin;
    use TitlePlugin;

    /** @var LayerId */
    private $layerId;

    /** @var bool */
    private $initialVisible;

    public function __construct(LayerId $layerId, string $name, bool $initialVisible)
    {
        $this->layerId        = $layerId;
        $this->name           = $name;
        $this->initialVisible = $initialVisible;
    }

    public function layerId() : LayerId
    {
        return $this->layerId;
    }

    public function initialVisible() : bool
    {
        return $this->initialVisible;
    }
}
