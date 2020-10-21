<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\FullscreenControl;
use Cowegis\Core\Serializer\DataSerializer;

use function assert;

final class FullscreenControlSerializer extends DataSerializer
{
    /**
     * @param FullscreenControl|mixed $data
     *
     * @return array<string,mixed>
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($data): array
    {
        assert($data instanceof FullscreenControl);

        return [
            'controlId' => $data->controlId()->value(),
            'type'      => 'fullscreen',
            'options'   => $this->serializer->serialize($data->options()),
        ];
    }
}
