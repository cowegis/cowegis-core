<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Map;

use Iterator;

final class PaneIterator implements Iterator
{
    /**
     * @psalm-var list<Pane>
     * @var Pane[]
     */
    private $panes;

    /** @var int */
    private $index = 0;

    /**
     * @param Pane[] $panes
     *
     * @psalm-param list<Pane> $panes
     */
    public function __construct(array $panes)
    {
        $this->panes = $panes;
    }

    /**
     * @param Pane[] $panes
     *
     * @psalm-param list<Pane> $panes
     */
    public static function fromArray(array $panes): self
    {
        return new self($panes);
    }

    public static function fromList(Pane ...$panes): self
    {
        return new self($panes);
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
