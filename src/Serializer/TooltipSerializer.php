<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\UI\Tooltip;
use function assert;

final class TooltipSerializer extends DataSerializer
{
    public function serialize($tooltip) : array
    {
        assert($tooltip instanceof Tooltip);

        return [
            'content'        => $tooltip->content(),
            'coordinates'    => $tooltip->coordinates(),
            'options'        => $this->serializer->serialize($tooltip->options()),
            'presetId'       => $tooltip->presetId() ? $tooltip->presetId()->value() : null,
            'events'         => $tooltip->events(),
        ];
    }
}
