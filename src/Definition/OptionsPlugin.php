<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\Constraints;

trait OptionsPlugin
{
    protected Options|null $options = null;

    public function options(): Options
    {
        if ($this->options === null) {
            $this->options = new Options(new Constraints($this->optionConstraints()));
        }

        return $this->options;
    }

    /** @return array<string, Constraint> */
    abstract protected function optionConstraints(): array;
}
