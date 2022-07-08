<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\ZoomControl;
use Cowegis\Core\Serializer\DataSerializer;

use function assert;

final class ZoomControlSerializer extends DataSerializer
{
    /**
     * @param ZoomControl|mixed $data
     *
     * @return array<string,mixed>
     */
    public function serialize($data): array
    {
        assert($data instanceof ZoomControl);

        return [
            'controlId'       => $data->controlId()->value(),
            'type'            => 'zoom',
            'options'         => $this->serializer->serialize($data->options()),
            'replacesDefault' => $data->replacesDefault(),
        ];
    }
}
