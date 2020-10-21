<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\LayersControl;
use Cowegis\Core\Serializer\DataSerializer;

use function assert;

final class LayersControlSerializer extends DataSerializer
{
    /**
     * @param LayersControl $control
     *
     * @return array<string,mixed>
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($control): array
    {
        assert($control instanceof LayersControl);

        return [
            'controlId'  => $control->controlId()->value(),
            'type'       => 'layers',
            'baseLayers' => $this->serializer->serialize($control->baseLayers()),
            'overlays'   => $this->serializer->serialize($control->overlays()),
            'options'    => $this->serializer->serialize($control->options()),
        ];
    }
}
