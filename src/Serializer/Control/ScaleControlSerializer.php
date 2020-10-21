<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\ScaleControl;
use Cowegis\Core\Serializer\DataSerializer;

use function assert;

final class ScaleControlSerializer extends DataSerializer
{
    /**
     * @param ScaleControl $data
     *
     * @return array<string,mixed>
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($data): array
    {
        assert($data instanceof ScaleControl);

        return [
            'controlId' => $data->controlId()->value(),
            'type'      => 'scale',
            'options'   => $this->serializer->serialize($data->options()),
        ];
    }
}
