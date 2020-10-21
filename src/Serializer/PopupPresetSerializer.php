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
     * @param PopupPreset $popup
     *
     * @return array<string, mixed>
     *
     * @psalm-return TSerializedPopupPreset
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($popup): array
    {
        assert($popup instanceof PopupPreset);

        return [
            'presetId' => $popup->popupPresetId()->value(),
            'options'  => $this->serializer->serialize($popup->options()),
        ];
    }
}
