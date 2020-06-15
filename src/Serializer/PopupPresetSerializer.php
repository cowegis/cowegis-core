<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Preset\PopupPreset;
use function assert;

final class PopupPresetSerializer extends DataSerializer
{
    public function serialize($popup) : array
    {
        assert($popup instanceof PopupPreset);

        return [
            'presetId' => $popup->popupPresetId()->value(),
            'options'  => $this->serializer->serialize($popup->options()),
        ];
    }
}
