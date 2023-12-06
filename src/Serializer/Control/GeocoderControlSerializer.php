<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\GeocoderControl;
use Cowegis\Core\Serializer\DataSerializer;

/** @extends DataSerializer<GeocoderControl> */
final class GeocoderControlSerializer extends DataSerializer
{
    /** {@inheritDoc} */
    public function serialize($data): array
    {
        return [
            'controlId' => $data->controlId()->value(),
            'name'      => $data->name(),
            'type'      => 'geocoder',
            'options'   => $this->serializer->serialize($data->options()),
            'geocoder'  => $data->geocoder(),
        ];
    }
}
