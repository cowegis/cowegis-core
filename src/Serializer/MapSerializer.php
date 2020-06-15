<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Control\Controls;
use Cowegis\Core\Definition\Map\Map;
use Cowegis\Core\Definition\Map\Pane;
use Cowegis\Core\Definition\Map\Panes;
use Cowegis\Core\Definition\Map\View;
use function assert;

final class MapSerializer extends DataSerializer
{
    public function serialize($map) : array
    {
        assert($map instanceof Map);

        return [
            'definitionId'     => $map->mapId()->value(),
            'elementId' => $map->elementId(),
            'title'     => $map->title(),
            'options'   => $this->serializer->serialize($map->options()),
            'layers'    => $this->serializeLayers($map),
            'controls'  => $this->serializeControls($map->controls()),
            'panes'     => $this->serializePanes($map->panes()),
            'view'      => $this->serializeView($map->view()),
            'locate'    => $this->serializeLocate($map),
            'bounds'    => $this->serializer->serialize($map->boundsOptions()),
            'presets'   => $this->serializer->serialize($map->presets()),
            'events'    => $this->serializer->serialize($map->events()),
        ];
    }

    private function serializeLayers(Map $map) : array
    {
        $data = [];
        foreach ($map->layers() as $layer) {
            $serialized = $this->serializer->serialize($layer);

            $data[] = $serialized;
        }

        return $data;
    }

    private function serializeControls(Controls $controls) : array
    {
        $data = [];
        foreach ($controls as $control) {
            $data[] = $this->serializer->serialize($control);
        }

        return $data;
    }

    private function serializePanes(Panes $panes) : array
    {
        $data = [];

        /** @var Pane $pane */
        foreach ($panes as $pane) {
            $data[] = $this->serializer->serialize($pane);
        }

        return $data;
    }

    private function serializeLocate(Map $map)
    {
        if ($map->locate() === false) {
            return false;
        }

        $options = $map->locateOptions();
        if (count($options) === 0) {
            return true;
        }

        return $this->serializer->serialize($map->locateOptions());
    }

    private function serializeView(View $view) : array
    {
        return [
            'center'  => $view->center(),
            'zoom'    => $view->zoom(),
            'options' => $this->serializer->serialize($view->options()),
        ];
    }
}
