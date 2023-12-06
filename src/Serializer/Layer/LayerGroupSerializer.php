<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\LayerGroup;

/** @extends MapLayerSerializer<LayerGroup> */
class LayerGroupSerializer extends MapLayerSerializer
{
    /** {@inheritDoc}*/
    public function serialize(mixed $data): array
    {
        $serialized         = parent::serialize($data);
        $serialized['type'] = $this->type();
        /** @psalm-var list<array<string, mixed>> */
        $serialized['layers'] = $this->serializer->serialize($data->layers());

        return $serialized;
    }

    protected function type(): string
    {
        return 'layerGroup';
    }
}
