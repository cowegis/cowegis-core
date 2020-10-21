<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\TileLayer;
use Cowegis\Core\Exception\RuntimeException;

final class TileLayerSerializer extends MapLayerSerializer
{
    /** @param mixed $object */
    public function supports($object): bool
    {
        return $object instanceof TileLayer;
    }

    /**
     * @param TileLayer|mixed $layer
     *
     * @return array<string,mixed>
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($layer): array
    {
        if (! $layer instanceof TileLayer) {
            throw new RuntimeException('Unsupported layer type');
        }

        $data                = parent::serialize($layer);
        $data['type']        = 'tileLayer';
        $data['urlTemplate'] = $layer->urlTemplate();

        return $data;
    }
}
