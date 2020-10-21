<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\UI\Popup;

use function assert;

/**
 * @psalm-import-type TEvent from \Cowegis\Core\Definition\Event\Events
 * @psalm-type TSerializedPopup = array{
 *   content: string,
 *   presetId: mixed,
 *   options: array<string,mixed>,
 *   events: list<TEvent>
 * }
 */
final class PopupSerializer extends DataSerializer
{
    /**
     * @param Popup $popup
     *
     * @return array<string, mixed>
     *
     * @psalm-return TSerializedPopup
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($popup): array
    {
        assert($popup instanceof Popup);

        return [
            'content'  => $popup->content(),
            'presetId' => $popup->presetId() ? $popup->presetId()->value() : null,
            'options'  => $this->serializer->serialize($popup->options()),
            'events'   => $this->serializer->serialize($popup->events()),
        ];
    }
}
