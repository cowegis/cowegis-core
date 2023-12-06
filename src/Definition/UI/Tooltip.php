<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\UI;

use Cowegis\Core\Definition\Event\EventsPlugin;
use Cowegis\Core\Definition\HasEvents;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LayerObject;
use Cowegis\Core\Definition\Map\Map;
use Cowegis\Core\Definition\Preset\TooltipPresetId;
use Cowegis\Core\Exception\RuntimeException;

final class Tooltip extends LayerObject implements HasEvents
{
    use EventsPlugin;
    use TooltipOptionsPlugin;

    public function __construct(
        private readonly string $content,
        private readonly LatLng|null $coordinates = null,
        private readonly TooltipPresetId|null $presetId = null,
    ) {
    }

    public function addTo(Map $map): void
    {
        throw new RuntimeException('Add to map is not supported right so far.');
    }

    public function content(): string
    {
        return $this->content;
    }

    public function coordinates(): LatLng|null
    {
        return $this->coordinates;
    }

    public function presetId(): TooltipPresetId|null
    {
        return $this->presetId;
    }
}
