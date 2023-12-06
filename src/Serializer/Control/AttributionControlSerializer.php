<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\AttributionControl;
use Cowegis\Core\Serializer\DataSerializer;

/** @extends DataSerializer<AttributionControl> */
final class AttributionControlSerializer extends DataSerializer
{
    /** {@inheritDoc} */
    public function serialize($data): array
    {
        return [
            'controlId'       => $data->controlId()->value(),
            'name'            => $data->name(),
            'type'            => 'attribution',
            'options'         => $this->serializer->serialize($data->options()),
            'attributions'    => $data->attributions(),
            'replacesDefault' => $data->replacesDefault(),
        ];
    }
}
