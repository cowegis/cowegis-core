<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\ProviderLayer;
use Override;

/** @extends MapLayerSerializer<ProviderLayer> */
final class ProviderLayerSerializer extends MapLayerSerializer
{
    /**
     * @param ProviderLayer $data
     *
     * @return array<string,mixed>
     */
    #[Override]
    public function serialize(mixed $data): array
    {
        $serialized             = parent::serialize($data);
        $serialized['type']     = 'provider';
        $serialized['provider'] = $data->provider();
        $serialized['variant']  = $data->variant();

        return $serialized;
    }
}
