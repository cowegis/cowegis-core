<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\EnumConstraint;
use Cowegis\Core\Definition\Control as ControlContract;
use Cowegis\Core\Definition\Map\Map;
use Cowegis\Core\Definition\OptionsPlugin;
use Cowegis\Core\Definition\TitlePlugin;

abstract class Control implements ControlContract
{
    use OptionsPlugin;
    use TitlePlugin;

    private ControlId $controlId;

    private string $name;

    public function __construct(ControlId $controlId, string $name)
    {
        $this->controlId = $controlId;
        $this->name      = $name;
    }

    public function controlId(): ControlId
    {
        return $this->controlId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function addTo(Map $map): void
    {
        $map->controls()->add($this);
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        return [
            'position' => EnumConstraint::withDefaultValue(
                ['topleft', 'topright', 'bottomleft', 'bottomright'],
                $this->defaultPosition()
            ),
        ];
    }

    abstract protected function defaultPosition(): ?string;
}
