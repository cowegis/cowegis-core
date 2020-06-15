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
    private $Controls;

    /** @var int */
    private $index = 0;

    /**
     * ControlIterator constructor.
     *
     * @psalm-var list<Control> $Controls
     *
     * @param Control[] $Controls
     */
    public function __construct(array $Controls)
    {
        $this->Controls = $Controls;
    }

    public static function fromArray(array $Controls) : self
    {
        return new self($Controls);
    }

    public static function fromList(Control ... $Controls) : self
    {
        return new self($Controls);
    }

    public function current() : Control
    {
        return $this->Controls[$this->index];
    }

    public function next() : void
    {
        $this->index++;
    }

    public function key() : int
    {
        return $this->index;
    }

    public function valid() : bool
    {
        return isset($this->Controls[$this->index]);
    }

    public function rewind() : void
    {
        $this->index = 0;
    }
}
