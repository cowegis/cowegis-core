<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\GeocoderControl;
use Cowegis\Core\Serializer\DataSerializer;

use function assert;

final class GeocoderControlSerializer extends DataSerializer
{
    /**
     * @param GeocoderControl|mixed $data
     *
     * @return array<string,mixed>
     */
    public function serialize($data): array
    {
        assert($data instanceof GeocoderControl);

        return [
            'controlId' => $data->controlId()->value(),
            'name'      => $data->name(),
            'type'      => 'geocoder',
            'options'   => $this->serializer->serialize($data->options()),
            'geocoder'  => $data->geocoder(),
        ];
    }
}
