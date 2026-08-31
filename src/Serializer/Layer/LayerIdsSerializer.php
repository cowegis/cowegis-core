<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Layer\LayerIds;
use Cowegis\Core\Serializer\Serializer;
use Override;

use function array_map;

/** @implements Serializer<LayerIds> */
final class LayerIdsSerializer implements Serializer
{
    /**
     * @param LayerIds $data
     *
     * @return array<int,mixed>
     * @psalm-return list<mixed>
     */
    #[Override]
    public function serialize(mixed $data): array
    {
        return array_map(
            /** @psalm-return mixed */
            static function (LayerId $layerId): string {
                return $layerId->value();
            },
            $data->toArray(),
        );
    }
}
