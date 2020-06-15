<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Constraint\Constraints;

trait OptionsPlugin
{
    /** @var Options|null */
    protected $options;

    public function options() : Options
    {
        if (null === $this->options) {
            $this->options = new Options(new Constraints($this->optionConstraints()));
        }

        return $this->options;
    }

    abstract protected function optionConstraints() : array;
}
