<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Preset\PopupPreset;

use function assert;

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
     * @return array<string, mixed>
     * @psalm-return TSerializedPopupPreset
     */
    public function serialize(mixed $data): array
    {
        assert($data instanceof PopupPreset);

        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($data->options());

        return [
            'presetId' => $data->popupPresetId()->value(),
            'options'  => $options,
        ];
    }
}
