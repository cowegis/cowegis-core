<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Preset\TooltipPreset;
use Override;

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
     * @param TooltipPreset $data
     *
     * @return array<string, mixed>
     * @psalm-return TSerializedTooltipPreset
     */
    #[Override]
    public function serialize(mixed $data): array
    {
        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($data->options());

        return [
            'presetId' => $data->tooltipPresetId()->value(),
            'options'  => $options,
        ];
    }
}
