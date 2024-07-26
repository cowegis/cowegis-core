<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Event\Events;
use Cowegis\Core\Definition\Preset\PopupPresetId;
use Cowegis\Core\Definition\UI\Popup;

use function assert;

/**
 * @extends DataSerializer<Popup>
 * @psalm-import-type TSerializedEvent from Events
 * @psalm-type TSerializedPopup = array{
 *   content: string,
 *   presetId: mixed,
 *   options: array<string,mixed>,
 *   events: list<TSerializedEvent>
 * }
 */
final class PopupSerializer extends DataSerializer
{
    /**
     * @return array<string, mixed>
     * @psalm-return TSerializedPopup
     */
    public function serialize(mixed $data): array
    {
        assert($data instanceof Popup);

        $presetId = $data->presetId();
        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($data->options());
        /** @psalm-var list<TSerializedEvent> $events */
        $events = $this->serializer->serialize($data->events());

        return [
            'content'  => $data->content(),
            'presetId' => $presetId instanceof PopupPresetId ? $presetId->value() : null,
            'options'  => $options,
            'events'   => $events,
        ];
    }
}
