<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Definition\Control;
use Cowegis\Core\Definition\DefinitionId;
use IteratorAggregate;

/** @extends IteratorAggregate<int, Control> */
interface Controls extends IteratorAggregate
{
    public function add(Control $control): void;

    public function has(Control $control): bool;

    public function remove(Control $control): void;

    public function get(DefinitionId $controlId): Control;

    public function getIterator(): ControlIterator;
}
