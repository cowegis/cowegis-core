<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\AttributionControl;
use Cowegis\Core\Serializer\DataSerializer;

use function assert;

final class AttributionControlSerializer extends DataSerializer
{
    /**
     * @param AttributionControl|mixed $data
     *
     * @return array<string,mixed>
     */
    public function serialize($data): array
    {
        assert($data instanceof AttributionControl);

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
