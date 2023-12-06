<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Layer;

use ArrayObject;
use Cowegis\Core\Definition\SimpleStyle\SimpleStyleMarker;
use Cowegis\Core\Definition\UI\Marker;
use Cowegis\Core\Serializer\Serializer;
use Cowegis\GeoJson\Feature\Feature;
use Cowegis\GeoJson\Geometry\Point;

/** @implements Serializer<Marker> */
final class MarkerSerializer implements Serializer
{
    public function __construct(private readonly Serializer $serializer)
    {
    }

    public function serialize(mixed $data): Feature
    {
        $properties = [
            'markerId'   => $data->markerId()->value(),
            'title'      => $data->title(),
            'name'       => $data->name(),
            'properties' => $this->serializer->serialize(new ArrayObject($data->properties()->toArray())),
            'options'    => $this->serializer->serialize($data->options()),
            'popup'      => $data->popup() ? $this->serializer->serialize($data->popup()) : null,
            'tooltip'    => $data->tooltip() ? $this->serializer->serialize($data->tooltip()) : null,
        ];

        $icon = $data->icon();
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

        return new Feature(new Point($data->coordinates()->toGeoJson()), $properties);
    }
}
