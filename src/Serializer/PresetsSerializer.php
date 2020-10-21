<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use ArrayObject;
use Cowegis\Core\Definition\Map\Presets;

use function assert;

/**
 * @psalm-import-type TSerializedIcon from \Cowegis\Core\Serializer\IconSerializer
 * @psalm-import-type TSerializedPopup from \Cowegis\Core\Serializer\PopupSerializer
 * @psalm-import-type TSerializedStyle from \Cowegis\Core\Serializer\StyleSerializer
 * @psalm-import-type TSerializedTooltip from \Cowegis\Core\Serializer\TooltipSerializer
 * @psalm-type TSerializedPresets = array{
 *   icons: \ArrayObject|array<string,TSerializedIcon>
 *   popups: \ArrayObject|array<string,TSerializedPopup>,
 *   styles: \ArrayObject|array<string,TSerializedStyle>,
 *   tooltips: \ArrayObject|array<string,TSerializedTooltip>
 * }
 */
final class PresetsSerializer extends DataSerializer
{
    /**
     * @param Presets $data
     *
     * @return array<string, mixed>
     *
     * @psalm-return TSerializedPresets
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($data): array
    {
        assert($data instanceof Presets);

        return [
            'icons'    => $this->serializer->serialize($data->icons()) ?: new ArrayObject(),
            'popups'   => $this->serializer->serialize($data->popups()) ?: new ArrayObject(),
            'styles'   => $this->serializer->serialize($data->styles()) ?: new ArrayObject(),
            'tooltips' => $this->serializer->serialize($data->tooltips()) ?: new ArrayObject(),
        ];
    }
}
