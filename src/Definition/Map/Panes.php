<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Map;

use Cowegis\Core\Exception\RuntimeException;
use IteratorAggregate;

use function array_values;
use function sprintf;

final class Panes implements IteratorAggregate
{
    /** @var Pane[] */
    private $panes = [];

    public function add(Pane $pane): void
    {
        $this->panes[$pane->paneId()->value()] = $pane;
    }

    public function has(Pane $pane): bool
    {
        if (! isset($this->panes[$pane->paneId()->value()])) {
            return false;
        }

        return $this->panes[$pane->paneId()->value()] === $pane;
    }

    public function get(PaneId $paneId): Pane
    {
        if (! isset($this->panes[$paneId->value()])) {
            throw new RuntimeException(sprintf('Pane "%s" not found', $paneId->value()));
        }

        return $this->panes[$paneId->value()];
    }

    public function remove(Pane $pane): void
    {
        unset($this->panes[$pane->paneId()->value()]);
    }

    public function getIterator(): PaneIterator
    {
        return new PaneIterator(array_values($this->panes));
    }
}
