<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Preset\PopupPreset;
use Cowegis\Core\Definition\Preset\TooltipPreset;
use function assert;

final class TooltipPresetSerializer extends DataSerializer
{
    public function serialize($tooltipPreset) : array
    {
        assert($tooltipPreset instanceof TooltipPreset);

        return [
            'presetId' => $tooltipPreset->tooltipPresetId()->value(),
            'options'  => $this->serializer->serialize($tooltipPreset->options()),
        ];
    }
}
