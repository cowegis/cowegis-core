<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use ArrayObject;
use Cowegis\Core\Definition\Map\Presets;
use function assert;

final class PresetsSerializer extends DataSerializer
{
    public function serialize($data) : array
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
