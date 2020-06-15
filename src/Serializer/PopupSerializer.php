<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\UI\Popup;
use function assert;

final class PopupSerializer extends DataSerializer
{
    public function serialize($popup) : array
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
