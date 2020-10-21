<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Definition\Control;
use Iterator;

final class ControlIterator implements Iterator
{
    /**
     * @psalm-var list<Control>
     * @var Control[]
     */
    private $controls;

    /** @var int */
    private $index = 0;

    /**
     * @param Control[] $controls
     *
     * @psalm-var list<Control> $controls
     */
    public function __construct(array $controls)
    {
        $this->controls = $controls;
    }

    /**
     * @param Control[] $controls
     *
     * @psalm-var list<Control> $controls
     */
    public static function fromArray(array $controls): self
    {
        return new self($controls);
    }

    public static function fromList(Control ...$controls): self
    {
        return new self($controls);
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
