<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Preset\TooltipPreset;

use function assert;

/**
 * @psalm-type TSerializedToolTipPreset = array{
 *   presetId: mixed,
 *   options: array<string,mixed>
 * }
 */
final class TooltipPresetSerializer extends DataSerializer
{
    /**
     * @param TooltipPreset $tooltipPreset
     *
     * @return array<string, mixed>
     *
     * @psalm-return TSerializedToolTipPreset
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($tooltipPreset): array
    {
        assert($tooltipPreset instanceof TooltipPreset);

        return [
            'presetId' => $tooltipPreset->tooltipPresetId()->value(),
            'options'  => $this->serializer->serialize($tooltipPreset->options()),
        ];
    }
}
