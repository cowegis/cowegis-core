<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\ScaleControl;
use Cowegis\Core\Serializer\DataSerializer;

use function assert;

final class ScaleControlSerializer extends DataSerializer
{
    /**
     * @param ScaleControl|mixed $data
     *
     * @return array<string,mixed>
     */
    public function serialize($data): array
    {
        assert($data instanceof ScaleControl);

        return [
            'controlId' => $data->controlId()->value(),
            'name'      => $data->name(),
            'type'      => 'scale',
            'options'   => $this->serializer->serialize($data->options()),
        ];
    }
}
