<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use ArrayObject;
use Cowegis\Core\Definition\SimpleStyle\SimpleStyleMarker;
use Cowegis\Core\Definition\UI\Marker;
use Cowegis\Core\Serializer\Serializer;
use Cowegis\GeoJson\Feature\Feature;
use Cowegis\GeoJson\Geometry\Point;

use function assert;

final class MarkerSerializer implements Serializer
{
    /** @var Serializer */
    private $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param Marker|mixed $marker
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($marker): Feature
    {
        assert($marker instanceof Marker);

        $properties = [
            'markerId'   => $marker->markerId()->value(),
            'title'      => $marker->title(),
            'name'       => $marker->name(),
            'properties' => $this->serializer->serialize(new ArrayObject($marker->properties()->toArray())),
            'options'    => $this->serializer->serialize($marker->options()),
            'popup'      => $marker->popup() ? $this->serializer->serialize($marker->popup()) : null,
            'tooltip'    => $marker->tooltip() ? $this->serializer->serialize($marker->tooltip()) : null,
        ];

        $icon = $marker->icon();
        if ($icon !== null) {
            /** @psalm-var mixed */
            $properties['icon'] = $this->serializer->serialize($icon->iconId()->value());
        }

        if ($icon instanceof SimpleStyleMarker) {
            /** @psalm-var mixed */
            $properties['marker-symbol'] = $icon->markerSymbol();
            $properties['marker-size']   = $icon->markerSize();
            $properties['marker-color']  = $icon->markerColor();
            $properties['symbol-color']  = $icon->symbolColor();
        }

        return new Feature(new Point($marker->coordinates()->toGeoJson()), $properties);
    }
}
