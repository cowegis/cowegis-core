<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Map;

use Iterator;

use function array_values;

/** @implements Iterator<int,Pane> */
final class PaneIterator implements Iterator
{
    private int $index = 0;

    /** @param list<Pane> $panes */
    public function __construct(private readonly array $panes)
    {
    }

    /** @param list<Pane> $panes */
    public static function fromArray(array $panes): self
    {
        return new self($panes);
    }

    public static function fromList(Pane ...$panes): self
    {
        return new self(array_values($panes));
    }

    public function current(): Pane
    {
        return $this->panes[$this->index];
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
        return isset($this->panes[$this->index]);
    }

    public function rewind(): void
    {
        $this->index = 0;
    }
}
