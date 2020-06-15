<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\UI\Marker;
use Cowegis\Core\Provider\LayerData\MarkersLayerData;
use Cowegis\Core\Serializer\Serializer;
use Cowegis\GeoJson\Feature\FeatureCollection;

final class MarkersLayerDataSerializer implements Serializer
{
    /** @var Serializer */
    private $serializer;

    /**
     * MarkersLayerDataSerializer constructor.
     *
     * @param Serializer $serializer
     */
    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    public function serialize($data)
    {
        assert($data instanceof MarkersLayerData);

        $features = [];
        /** @var Marker $marker */
        foreach ($data as $marker) {
            $features[] = $this->serializer->serialize($marker);
        }

        return new FeatureCollection($features);
    }
}
