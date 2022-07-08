<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Preset\PopupPreset;

use function assert;

/**
 * @psalm-type TSerializedPopupPreset = array{
 *   presetId: mixed,
 *   options: array<string,mixed>
 * }
 */
final class PopupPresetSerializer extends DataSerializer
{
    /**
     * @param PopupPreset|mixed $popup
     *
     * @return array<string, mixed>
     * @psalm-return TSerializedPopupPreset
     */
    public function serialize($popup): array
    {
        assert($popup instanceof PopupPreset);

        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($popup->options());

        return [
            'presetId' => $popup->popupPresetId()->value(),
            'options'  => $options,
        ];
    }
}
