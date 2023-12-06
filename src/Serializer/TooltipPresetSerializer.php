<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Preset\TooltipPreset;

use function assert;

/**
 * @extends DataSerializer<TooltipPreset>
 * @psalm-type TSerializedTooltipPreset = array{
 *   presetId: mixed,
 *   options: array<string,mixed>
 * }
 */
final class TooltipPresetSerializer extends DataSerializer
{
    /**
     * @return array<string, mixed>
     * @psalm-return TSerializedTooltipPreset
     */
    public function serialize(mixed $data): array
    {
        assert($data instanceof TooltipPreset);

        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($data->options());

        return [
            'presetId' => $data->tooltipPresetId()->value(),
            'options'  => $options,
        ];
    }
}
