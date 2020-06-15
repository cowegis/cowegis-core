<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\LoadingControl;
use Cowegis\Core\Serializer\DataSerializer;
use function assert;

final class LoadingControlSerializer extends DataSerializer
{
    public function serialize($data) : array
    {
        assert($data instanceof LoadingControl);

        return [
            'controlId' => $data->controlId()->value(),
            'type'      => 'loading',
            'options'   => $this->serializer->serialize($data->options()),
        ];
    }
}
