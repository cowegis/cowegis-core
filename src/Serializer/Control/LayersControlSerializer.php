<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\LayersControl;
use Cowegis\Core\Serializer\DataSerializer;
use Override;

/** @extends DataSerializer<LayersControl> */
final class LayersControlSerializer extends DataSerializer
{
    /** {@inheritDoc} */
    #[Override]
    public function serialize($data): array
    {
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
