<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use Cowegis\Core\Exception\RuntimeException;
use IteratorAggregate;

use function array_values;
use function sprintf;

final class Layers implements IteratorAggregate
{
    /** @var array<string, Layer>|Layer[] */
    private $layers = [];

    public function add(Layer $layer): void
    {
        $this->layers[$layer->layerId()->value()] = $layer;
    }

    public function has(Layer $layer): bool
    {
        if (! isset($this->layers[$layer->layerId()->value()])) {
            return false;
        }

        return $this->layers[$layer->layerId()->value()] === $layer;
    }

    public function get(LayerId $layerId): Layer
    {
        if (! isset($this->layers[$layerId->value()])) {
            throw new RuntimeException(sprintf('Layer "%s" not found', $layerId->value()));
        }

        return $this->layers[$layerId->value()];
    }

    public function remove(Layer $layer): void
    {
        unset($this->layers[$layer->layerId()->value()]);
    }

    public function getIterator(): LayerIterator
    {
        return new LayerIterator(array_values($this->layers));
    }
}
