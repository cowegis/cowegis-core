<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\ZoomControl;
use Cowegis\Core\Serializer\DataSerializer;

/** @extends DataSerializer<ZoomControl> */
final class ZoomControlSerializer extends DataSerializer
{
    /** {@inheritDoc} */
    public function serialize($data): array
    {
        return [
            'controlId'       => $data->controlId()->value(),
            'name'            => $data->name(),
            'type'            => 'zoom',
            'options'         => $this->serializer->serialize($data->options()),
            'replacesDefault' => $data->replacesDefault(),
        ];
    }
}
