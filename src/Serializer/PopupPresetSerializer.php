<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Preset\PopupPreset;
use Override;

/**
 * @extends DataSerializer<PopupPreset>
 * @psalm-type TSerializedPopupPreset = array{
 *   presetId: mixed,
 *   options: array<string,mixed>
 * }
 */
final class PopupPresetSerializer extends DataSerializer
{
    /**
     * @param PopupPreset $data
     *
     * @return array<string, mixed>
     * @psalm-return TSerializedPopupPreset
     */
    #[Override]
    public function serialize(mixed $data): array
    {
        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($data->options());

        return [
            'presetId' => $data->popupPresetId()->value(),
            'options'  => $options,
        ];
    }
}
