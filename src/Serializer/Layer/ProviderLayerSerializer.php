<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\ProviderLayer;

use function assert;

/** @extends MapLayerSerializer<ProviderLayer> */
final class ProviderLayerSerializer extends MapLayerSerializer
{
    /** @return array<string,mixed> */
    public function serialize(mixed $data): array
    {
        assert($data instanceof ProviderLayer);

        $serialized             = parent::serialize($data);
        $serialized['type']     = 'provider';
        $serialized['provider'] = $data->provider();
        $serialized['variant']  = $data->variant();

        return $serialized;
    }
}
