<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\UI;

use Cowegis\Core\Definition\Event\EventsPlugin;
use Cowegis\Core\Definition\HasEvents;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LayerObject;
use Cowegis\Core\Definition\Preset\TooltipPresetId;

final class Tooltip extends LayerObject implements HasEvents
{
    use EventsPlugin;
    use TooltipOptionsPlugin;

    /** @var string */
    private $content;

    /** @var LatLng|null */
    private $coordinates;

    /** @var TooltipPresetId|null */
    private $presetId;

    public function __construct(string $content, ?LatLng $coordinates = null, ?TooltipPresetId $presetId = null)
    {
        $this->content     = $content;
        $this->coordinates = $coordinates;
        $this->presetId    = $presetId;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function coordinates(): ?LatLng
    {
        return $this->coordinates;
    }

    public function presetId(): ?TooltipPresetId
    {
        return $this->presetId;
    }
}
