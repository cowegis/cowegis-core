<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\LayersControl;
use Cowegis\Core\Serializer\DataSerializer;

use function assert;

final class LayersControlSerializer extends DataSerializer
{
    /**
     * @param LayersControl|mixed $data
     *
     * @return array<string,mixed>
     */
    public function serialize($data): array
    {
        assert($data instanceof LayersControl);

        return [
            'controlId'  => $data->controlId()->value(),
            'name'       => $data->name(),
            'type'       => 'layers',
            'baseLayers' => $this->serializer->serialize($data->baseLayers()),
            'overlays'   => $this->serializer->serialize($data->overlays()),
            'options'    => $this->serializer->serialize($data->options()),
        ];
    }
}
