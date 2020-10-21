<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\LayerGroup;

use function assert;

class LayerGroupSerializer extends MapLayerSerializer
{
    /**
     * @param LayerGroup|mixed $layer
     *
     * @return array<string,mixed>
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($layer): array
    {
        assert($layer instanceof LayerGroup);

        $data         = parent::serialize($layer);
        $data['type'] = $this->type();
        /** @psalm-var list<array<string, mixed>> */
        $data['layers'] = $this->serializer->serialize($layer->layers());

        return $data;
    }

    protected function type(): string
    {
        return 'layerGroup';
    }
}
