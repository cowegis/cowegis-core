<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use ArrayObject;
use Cowegis\Core\Definition\Map\Presets;

use function assert;

/**
 * @extends DataSerializer<Presets>
 * @psalm-import-type TSerializedIcon from IconSerializer
 * @psalm-import-type TSerializedPopup from PopupSerializer
 * @psalm-import-type TSerializedTooltip from TooltipSerializer
 * @psalm-type TSerializedPresets = array{
 *   icons: ArrayObject|array<string,TSerializedIcon>,
 *   popups: ArrayObject|array<string,TSerializedPopup>,
 *   styles: ArrayObject|array<string,mixed>,
 *   tooltips: ArrayObject|array<string,TSerializedTooltip>
 * }
 */
final class PresetsSerializer extends DataSerializer
{
    /**
     * @return array<string, mixed>
     * @psalm-return TSerializedPresets
     */
    public function serialize(mixed $data): array
    {
        assert($data instanceof Presets);

        /** @psalm-var ArrayObject|array<string,TSerializedIcon> $icons */
        $icons = $this->serializer->serialize($data->icons()) ?: new ArrayObject();
        /** @psalm-var ArrayObject|array<string,TSerializedPopup> $popups */
        $popups = $this->serializer->serialize($data->popups()) ?: new ArrayObject();
        /** @psalm-var ArrayObject|array<string,mixed> $styles */
        $styles = $this->serializer->serialize($data->styles()) ?: new ArrayObject();
        /** @psalm-var ArrayObject|array<string,TSerializedTooltip> $tooltips */
        $tooltips = $this->serializer->serialize($data->tooltips()) ?: new ArrayObject();

        return [
            'icons'    => $icons,
            'popups'   => $popups,
            'styles'   => $styles,
            'tooltips' => $tooltips,
        ];
    }
}
