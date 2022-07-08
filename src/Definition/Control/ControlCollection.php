<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Definition\Control;
use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Exception\RuntimeException;

use function array_values;
use function sprintf;

final class ControlCollection implements Controls
{
    /** @var Control[] */
    private array $controls = [];

    public function add(Control $control): void
    {
        $this->controls[$control->controlId()->value()] = $control;
    }

    public function has(Control $control): bool
    {
        if (! isset($this->controls[$control->controlId()->value()])) {
            return false;
        }

        return $this->controls[$control->controlId()->value()] === $control;
    }

    public function get(DefinitionId $controlId): Control
    {
        if (! isset($this->controls[$controlId->value()])) {
            throw new RuntimeException(sprintf('Control "%s" not found', $controlId->value()));
        }

        return $this->controls[$controlId->value()];
    }

    public function remove(Control $control): void
    {
        unset($this->controls[$control->controlId()->value()]);
    }

    public function getIterator(): ControlIterator
    {
        return new ControlIterator(array_values($this->controls));
    }
}
