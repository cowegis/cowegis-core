<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\UI\Marker;
use Cowegis\Core\Provider\LayerData\MarkersLayerData;
use Cowegis\Core\Serializer\Serializer;
use Cowegis\GeoJson\Feature\Feature;
use Cowegis\GeoJson\Feature\FeatureCollection;

use function assert;

/** @implements Serializer<MarkersLayerData> */
final class MarkersLayerDataSerializer implements Serializer
{
    public function __construct(private readonly Serializer $serializer)
    {
    }

    public function serialize(mixed $data): FeatureCollection
    {
        $features = [];
        foreach ($data as $marker) {
            assert($marker instanceof Marker);
            /** @psalm-var Feature */
            $features[] = $this->serializer->serialize($marker);
        }

        return new FeatureCollection($features);
    }
}
