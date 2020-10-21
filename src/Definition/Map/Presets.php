<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Map;

use Cowegis\Core\Definition\Icon\Icon;
use Cowegis\Core\Definition\Path\Style;
use Cowegis\Core\Definition\Preset\PopupPreset;
use Cowegis\Core\Definition\Preset\TooltipPreset;
use Cowegis\Core\Definition\UI\Popup;
use Cowegis\Core\Definition\UI\Tooltip;

final class Presets
{
    /** @var Icon[] */
    private $icons = [];

    /** @var Popup[] */
    private $popups = [];

    /** @var Style[] */
    private $styles = [];

    /** @var Tooltip[] */
    private $tooltips = [];

    public function addPopup(PopupPreset $popup): void
    {
        $this->popups[$popup->popupPresetId()->value()] = $popup;
    }

    public function addTooltip(TooltipPreset $tooltip): void
    {
        $this->tooltips[$tooltip->tooltipPresetId()->value()] = $tooltip;
    }

    public function addIcon(Icon $icon): void
    {
        $this->icons[$icon->iconId()->value()] = $icon;
    }

    /** @return Icon[] */
    public function icons(): array
    {
        return $this->icons;
    }

    /** @return Popup[] */
    public function popups(): array
    {
        return $this->popups;
    }

    /** @return Style[] */
    public function styles(): array
    {
        return $this->styles;
    }

    /** @return Tooltip[] */
    public function tooltips(): array
    {
        return $this->tooltips;
    }
}
