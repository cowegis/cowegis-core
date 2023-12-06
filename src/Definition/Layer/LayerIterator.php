<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use Cowegis\Core\Definition\Layer;
use Iterator;

use function array_values;

/** @implements Iterator<int, Layer> */
final class LayerIterator implements Iterator
{
    private int $index = 0;

    /** @param list<Layer> $layers */
    public function __construct(private readonly array $layers)
    {
    }

    /** @param list<Layer> $layers */
    public static function fromArray(array $layers): self
    {
        return new self($layers);
    }

    public static function fromList(Layer ...$layers): self
    {
        return new self(array_values($layers));
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
