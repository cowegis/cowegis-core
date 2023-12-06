<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Event\Events;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\UI\Tooltip;

/**
 * @extends DataSerializer<Tooltip>
 * @psalm-import-type TSerializedEvent from Events
 * @psalm-import-type TSerializedLatLng from LatLng
 * @psalm-type TSerializedTooltip = array{
 *   content: string,
 *   coordinates: TSerializedLatLng|null,
 *   options: array<string, mixed>,
 *   presetId: mixed,
 *   events: list<TSerializedEvent>
 * }
 */
final class TooltipSerializer extends DataSerializer
{
    /**
     * @param Tooltip $data
     *
     * @return array<string,mixed>
     * @psalm-return TSerializedTooltip
     */
    public function serialize(mixed $data): array
    {
        /** @psalm-var array<string,mixed> $options */
        $options     = $this->serializer->serialize($data->options());
        $presetId    = $data->presetId();
        $coordinates = $data->coordinates();

        return [
            'content'        => $data->content(),
            'coordinates'    => $coordinates ? $coordinates->jsonSerialize() : null,
            'options'        => $options,
            'presetId'       => $presetId ? $presetId->value() : null,
            'events'         => $data->events()->jsonSerialize(),
        ];
    }
}
