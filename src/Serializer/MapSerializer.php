<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Control\Controls;
use Cowegis\Core\Definition\Event\Events;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\Map\Map;
use Cowegis\Core\Definition\Map\Pane;
use Cowegis\Core\Definition\Map\Panes;
use Cowegis\Core\Definition\Map\View;

use function assert;
use function count;

/**
 * @psalm-import-type TSerializedEvent from Events
 * @psalm-import-type TSerializedLatLng from LatLng
 * @psalm-import-type TSerializedPane from Pane
 * @psalm-import-type TSerializedPresets from PresetsSerializer
 * @psalm-type TSerializedView = array{
 *     center: TSerializedLatLng|null,
 *     zoom: float|null,
 *     options: array<string, mixed>
 * }
 * @psalm-type TSerializedMap = array{
 *   definitionId: mixed,
 *   elementId: string,
 *   title: string|null,
 *   options: array<string, mixed>,
 *   layers: list<array<string, mixed>>,
 *   controls: list<array<string, mixed>>,
 *   panes: list<TSerializedPane>,
 *   view: TSerializedView,
 *   locate: bool|array<string, mixed>,
 *   bounds: array<string, mixed>,
 *   presets: TSerializedPresets,
 *   events: list<TSerializedEvent>
 * }
 * @extends DataSerializer<Map>
 */
final class MapSerializer extends DataSerializer
{
    /**
     * @param Map|mixed $map
     *
     * @return array<string, mixed>
     * @psalm-return TSerializedMap
     */
    public function serialize($map): array
    {
        assert($map instanceof Map);

        /** @psalm-var array<string, mixed> */
        $options = $this->serializer->serialize($map->options());
        /** @psalm-var array<string, mixed> */
        $bounds = $this->serializer->serialize($map->boundsOptions());
        /** @psalm-var TSerializedPresets */
        $presets = $this->serializer->serialize($map->presets());
        /** @psalm-var list<TSerializedEvent> */
        $events = $this->serializer->serialize($map->events());

        return [
            'definitionId' => $map->mapId()->value(),
            'elementId'    => $map->elementId(),
            'title'        => $map->title(),
            'options'      => $options,
            'layers'       => $this->serializeLayers($map),
            'controls'     => $this->serializeControls($map->controls()),
            'panes'        => $this->serializePanes($map->panes()),
            'view'         => $this->serializeView($map->view()),
            'locate'       => $this->serializeLocate($map),
            'bounds'       => $bounds,
            'presets'      => $presets,
            'events'       => $events,
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     * @psalm-return list<array<string, mixed>>
     */
    private function serializeLayers(Map $map): array
    {
        $data = [];
        foreach ($map->layers() as $layer) {
            /** @psalm-var array<string, mixed> */
            $data[] = $this->serializer->serialize($layer);
        }

        return $data;
    }

    /**
     * @return array<int, array<string, mixed>>
     * @psalm-return list<array<string, mixed>>
     */
    private function serializeControls(Controls $controls): array
    {
        $data = [];
        foreach ($controls as $control) {
            /** @psalm-var array<string, mixed> */
            $data[] = $this->serializer->serialize($control);
        }

        return $data;
    }

    /**
     * @return array<int, array<string, mixed>>
     * @psalm-return list<TSerializedPane>
     */
    private function serializePanes(Panes $panes): array
    {
        $data = [];

        foreach ($panes as $pane) {
            /** @psalm-var TSerializedPane $serialized */
            $serialized = $this->serializer->serialize($pane);
            $data[]     = $serialized;
        }

        return $data;
    }

    /**
     * @return bool|array<string, mixed>
     */
    private function serializeLocate(Map $map)
    {
        if ($map->locate() === false) {
            return false;
        }

        $options = $map->locateOptions();
        if (count($options) === 0) {
            return true;
        }

        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($map->options());

        return $options;
    }

    /**
     * @return array<string, mixed>
     * @psalm-return TSerializedView
     */
    private function serializeView(View $view): array
    {
        $center = $view->center();

        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($view->options());

        return [
            'center'  => $center ? $center->jsonSerialize() : null,
            'zoom'    => $view->zoom(),
            'options' => $options,
        ];
    }
}
