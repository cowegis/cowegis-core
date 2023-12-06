<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\LoadingControl;
use Cowegis\Core\Serializer\DataSerializer;

/** @extends DataSerializer<LoadingControl> */
final class LoadingControlSerializer extends DataSerializer
{
    /** {@inheritDoc} */
    public function serialize($data): array
    {
        return [
            'controlId' => $data->controlId()->value(),
            'name'      => $data->name(),
            'type'      => 'loading',
            'options'   => $this->serializer->serialize($data->options()),
        ];
    }
}
