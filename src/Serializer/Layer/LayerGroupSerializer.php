<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\LayerGroup;

class LayerGroupSerializer extends MapLayerSerializer
{
    public function serialize($layer) : array
    {
        assert($layer instanceof LayerGroup);

        $data           = parent::serialize($layer);
        $data['type']   = $this->type();
        $data['layers'] = $this->serializer->serialize($layer->layers());

        return $data;
    }

    protected function type() : string
    {
        return 'layerGroup';
    }
}
