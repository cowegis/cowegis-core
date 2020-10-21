<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\UI\Tooltip;

use function assert;

/**
 * @psalm-import-type TEvent from \Cowegis\Core\Definition\Event\Events
 * @psalm-import-type TSerializedLatLng from \Cowegis\Core\Definition\LatLng
 * @psalm-type TSerializedToolTip = array{
 *   content: string,
 *   coordinates: null|TSerializedLatLng,
 *   options: array<string,mixed>
 *   presetId: mixed,
 *   events: list<TEvent>
 * }
 */
final class TooltipSerializer extends DataSerializer
{
    /**
     * @param Tooltip $tooltip
     *
     * @return array<string,mixed>
     *
     * @psalm-return TSerializedToolTip
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($tooltip): array
    {
        assert($tooltip instanceof Tooltip);
        $presetId = $tooltip->presetId();

        return [
            'content'        => $tooltip->content(),
            'coordinates'    => $tooltip->coordinates(),
            'options'        => $this->serializer->serialize($tooltip->options()),
            'presetId'       => $presetId ? $presetId->value() : null,
            'events'         => $tooltip->events()->jsonSerialize(),
        ];
    }
}
