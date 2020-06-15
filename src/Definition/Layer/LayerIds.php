<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use function array_filter;
use function array_values;

final class LayerIds
{
    /** @var LayerId[] */
    private $layers = [];

    public function addLayer(LayerId $layerId) : void
    {
        if ($this->hasLayer($layerId)) {
            return;
        }

        $this->layers[] = $layerId;
    }

    public function hasLayer(LayerId $layerId) : bool
    {
        foreach ($this->layers as $layer) {
            if ($layer->value() === $layerId->value()) {
                return true;
            }
        }

        return false;
    }

    public function removeLayer(LayerId $layerId) : void
    {
        $this->layers = array_values(
            array_filter(
                $this->layers,
                static function (LayerId $assignedLayerId) use ($layerId) : bool {
                    return $assignedLayerId->value() !== $layerId->value();
                }
            )
        );
    }

    public function toArray() : array
    {
        return $this->layers;
    }
}
