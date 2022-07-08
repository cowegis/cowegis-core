<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Preset\TooltipPreset;

use function assert;

/**
 * @psalm-type TSerializedTooltipPreset = array{
 *   presetId: mixed,
 *   options: array<string,mixed>
 * }
 */
final class TooltipPresetSerializer extends DataSerializer
{
    /**
     * @param TooltipPreset|mixed $tooltipPreset
     *
     * @return array<string, mixed>
     * @psalm-return TSerializedTooltipPreset
     */
    public function serialize($tooltipPreset): array
    {
        assert($tooltipPreset instanceof TooltipPreset);

        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($tooltipPreset->options());

        return [
            'presetId' => $tooltipPreset->tooltipPresetId()->value(),
            'options'  => $options,
        ];
    }
}
