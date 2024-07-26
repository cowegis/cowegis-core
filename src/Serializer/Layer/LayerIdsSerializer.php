<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Definition\Layer\LayerIds;
use Cowegis\Core\Serializer\Serializer;

use function array_map;
use function assert;

/** @implements Serializer<LayerIds> */
final class LayerIdsSerializer implements Serializer
{
    /**
     * @return array<int,mixed>
     * @psalm-return list<mixed>
     */
    public function serialize(mixed $data): array
    {
        assert($data instanceof LayerIds);

        return array_map(
            /** @psalm-return mixed */
            static function (LayerId $layerId): string {
                return $layerId->value();
            },
            $data->toArray(),
        );
    }
}
