<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\UI\Tooltip;

use function assert;

/**
 * @psalm-import-type TSerializedEvent from \Cowegis\Core\Definition\Event\Events
 * @psalm-import-type TSerializedLatLng from \Cowegis\Core\Definition\LatLng
 * @psalm-type TSerializedTooltip = array{
 *   content: string,
 *   coordinates: null|TSerializedLatLng,
 *   options: array<string,mixed>,
 *   presetId: mixed,
 *   events: list<TSerializedEvent>
 * }
 */
final class TooltipSerializer extends DataSerializer
{
    /**
     * @param Tooltip|mixed $tooltip
     *
     * @return array<string,mixed>
     *
     * @psalm-return TSerializedTooltip
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($tooltip): array
    {
        assert($tooltip instanceof Tooltip);

        /** @psalm-var array<string,mixed> $options */
        $options     = $this->serializer->serialize($tooltip->options());
        $presetId    = $tooltip->presetId();
        $coordinates = $tooltip->coordinates();

        return [
            'content'        => $tooltip->content(),
            'coordinates'    => $coordinates ? $coordinates->jsonSerialize() : null,
            'options'        => $options,
            'presetId'       => $presetId ? $presetId->value() : null,
            'events'         => $tooltip->events()->jsonSerialize(),
        ];
    }
}
