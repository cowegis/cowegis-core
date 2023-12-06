<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Definition\Control;
use Iterator;

use function array_values;

/** @implements Iterator<int, Control> */
final class ControlIterator implements Iterator
{
    private int $index = 0;

    /** @param list<Control> $controls */
    public function __construct(private readonly array $controls)
    {
    }

    /** @param list<Control> $controls */
    public static function fromArray(array $controls): self
    {
        return new self($controls);
    }

    public static function fromList(Control ...$controls): self
    {
        return new self(array_values($controls));
    }

    public function current(): Control
    {
        return $this->controls[$this->index];
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
        return isset($this->controls[$this->index]);
    }

    public function rewind(): void
    {
        $this->index = 0;
    }
}
