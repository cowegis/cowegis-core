<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

trait NamePlugin
{
    /** @var string */
    protected $name;

    public function name() : string
    {
        return $this->name;
    }
}
