<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\ProviderLayer;

use function assert;

final class ProviderLayerSerializer extends MapLayerSerializer
{
    /**
     * @param ProviderLayer|mixed $layer
     *
     * @return array<string,mixed>
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($layer): array
    {
        assert($layer instanceof ProviderLayer);

        $data             = parent::serialize($layer);
        $data['type']     = 'provider';
        $data['provider'] = $layer->provider();
        $data['variant']  = $layer->variant();

        return $data;
    }
}
