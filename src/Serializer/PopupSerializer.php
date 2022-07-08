<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Event\Events;
use Cowegis\Core\Definition\UI\Popup;

use function assert;

/**
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
     * @param Popup|mixed $popup
     *
     * @return array<string, mixed>
     * @psalm-return TSerializedPopup
     */
    public function serialize($popup): array
    {
        assert($popup instanceof Popup);

        $presetId = $popup->presetId();
        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($popup->options());
        /** @psalm-var list<TSerializedEvent> $events */
        $events = $this->serializer->serialize($popup->events());

        return [
            'content'  => $popup->content(),
            'presetId' => $presetId ? $presetId->value() : null,
            'options'  => $options,
            'events'   => $events,
        ];
    }
}
