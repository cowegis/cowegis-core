<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use Cowegis\Core\Definition\Layer;
use Iterator;

final class LayerIterator implements Iterator
{
    /**
     * @psalm-var list<Layer>
     * @var Layer[]
     */
    private $layers;

    /** @var int */
    private $index = 0;

    /**
     * @param Layer[] $layers
     * @psalm-param list<Layer> $layers
     */
    public function __construct(array $layers)
    {
        $this->layers = $layers;
    }

    /**
     * @param Layer[] $layers
     * @psalm-param list<Layer> $layers
     */
    public static function fromArray(array $layers): self
    {
        return new self($layers);
    }

    public static function fromList(Layer ...$layers): self
    {
        return new self($layers);
    }

    public function current(): Layer
    {
        return $this->layers[$this->index];
    }

    public function next(): void
    {
        $this->index++;
    }

    public function key(): int
    {
        return $this->index;
    }

    public function valid(): bool
    {
        return isset($this->layers[$this->index]);
    }

    public function rewind(): void
    {
        $this->index = 0;
    }
}
