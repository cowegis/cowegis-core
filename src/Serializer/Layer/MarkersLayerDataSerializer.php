<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use Cowegis\Core\Definition\UI\Marker;
use Cowegis\Core\Provider\LayerData\MarkersLayerData;
use Cowegis\Core\Serializer\Serializer;
use Cowegis\GeoJson\Feature\FeatureCollection;

use function assert;

final class MarkersLayerDataSerializer implements Serializer
{
    /** @var Serializer */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param MarkersLayerData $data
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($data): FeatureCollection
    {
        assert($data instanceof MarkersLayerData);

        $features = [];
        foreach ($data as $marker) {
            assert($marker instanceof Marker);
            $features[] = $this->serializer->serialize($marker);
        }

        return new FeatureCollection($features);
    }
}
