<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Control\Controls;
use Cowegis\Core\Definition\Map\Map;
use Cowegis\Core\Definition\Map\Panes;
use Cowegis\Core\Definition\Map\View;

use function assert;
use function count;

/**
 * @psalm-import-type TSerializedLatLng from \Cowegis\Core\Definition\LatLng
 * @psalm-import-type TSerializedPane from \Cowegis\Core\Definition\Map\Pane
 * @psalm-type TSerializedMap = array{
 *   definitionId: mixed,
 *   elementId: string,
 *   title: string|null,
 *   options: array<string, mixed>,
 *   layers: list<array<string, mixed>>,
 *   controls: list<array<string, mixed>>,
 *   panes: list<TSerializedPane>
 * }
 * @psalm-type TSerializedView = array{
 *   center: null|TSerializedLatLng,
 *   zoom: float|null,
 *   options: array<string, mixed>
 * }
 */
final class MapSerializer extends DataSerializer
{
    /**
     * @param Map|mixed $map
     *
     * @return array<string, mixed>
     *
     * @psalm-return TSerializedMap
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($map): array
    {
        assert($map instanceof Map);

        return [
            'definitionId' => $map->mapId()->value(),
            'elementId'    => $map->elementId(),
            'title'        => $map->title(),
            'options'      => $this->serializer->serialize($map->options()),
            'layers'       => $this->serializeLayers($map),
            'controls'     => $this->serializeControls($map->controls()),
            'panes'        => $this->serializePanes($map->panes()),
            'view'         => $this->serializeView($map->view()),
            'locate'       => $this->serializeLocate($map),
            'bounds'       => $this->serializer->serialize($map->boundsOptions()),
            'presets'      => $this->serializer->serialize($map->presets()),
            'events'       => $this->serializer->serialize($map->events()),
        ];
    }

    /**
     * @return array<int, array<string, mixed>>
     *
     * @psalm-return list<array<string, mixed>>
     */
    private function serializeLayers(Map $map): array
    {
        $data = [];
        foreach ($map->layers() as $layer) {
            $serialized = $this->serializer->serialize($layer);

            $data[] = $serialized;
        }

        return $data;
    }

    /**
     * @return array<int, array<string, mixed>>
     *
     * @psalm-return list<array<string, mixed>>
     */
    private function serializeControls(Controls $controls): array
    {
        $data = [];
        foreach ($controls as $control) {
            $data[] = $this->serializer->serialize($control);
        }

        return $data;
    }

    /**
     * @return array<int, array<string, mixed>>
     *
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
     *
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
