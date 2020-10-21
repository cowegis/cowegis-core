<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\LayerGroup;

use function assert;

class LayerGroupSerializer extends MapLayerSerializer
{
    /**
     * @param LayerGroup $layer
     *
     * @return array<string,mixed>
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($layer): array
    {
        assert($layer instanceof LayerGroup);

        $data           = parent::serialize($layer);
        $data['type']   = $this->type();
        $data['layers'] = $this->serializer->serialize($layer->layers());

        return $data;
    }

    protected function type(): string
    {
        return 'layerGroup';
    }
}
