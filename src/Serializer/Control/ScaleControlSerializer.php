<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\ScaleControl;
use Cowegis\Core\Serializer\DataSerializer;

/** @extends DataSerializer<ScaleControl> */
final class ScaleControlSerializer extends DataSerializer
{
    /** {@inheritDoc} */
    public function serialize(mixed $data): array
    {
        return [
            'controlId' => $data->controlId()->value(),
            'name'      => $data->name(),
            'type'      => 'scale',
            'options'   => $this->serializer->serialize($data->options()),
        ];
    }
}
