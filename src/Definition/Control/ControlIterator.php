<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Definition\Control;
use Iterator;
use Override;

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

    #[Override]
    public function current(): Control
    {
        return $this->controls[$this->index];
    }

    #[Override]
    public function next(): void
    {
        $this->index++;
    }

    #[Override]
    public function key(): int
    {
        return $this->index;
    }

    #[Override]
    public function valid(): bool
    {
        return isset($this->controls[$this->index]);
    }

    #[Override]
    public function rewind(): void
    {
        $this->index = 0;
    }
}
