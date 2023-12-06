<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\FullscreenControl;
use Cowegis\Core\Serializer\DataSerializer;

/** @extends DataSerializer<FullscreenControl> */
final class FullscreenControlSerializer extends DataSerializer
{
    /** {@inheritDoc} */
    public function serialize($data): array
    {
        return [
            'controlId' => $data->controlId()->value(),
            'name'      => $data->name(),
            'type'      => 'fullscreen',
            'options'   => $this->serializer->serialize($data->options()),
        ];
    }
}
