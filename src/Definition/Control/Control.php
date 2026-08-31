<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\EnumConstraint;
use Cowegis\Core\Definition\Control as ControlContract;
use Cowegis\Core\Definition\Map\Map;
use Cowegis\Core\Definition\OptionsPlugin;
use Cowegis\Core\Definition\TitlePlugin;
use Override;

abstract class Control implements ControlContract
{
    use OptionsPlugin;
    use TitlePlugin;

    public const POSITION_TOP_LEFT     = 'topleft';
    public const POSITION_TOP_RIGHT    = 'topright';
    public const POSITION_BOTTOM_LEFT  = 'bottomleft';
    public const POSITION_BOTTOM_RIGHT = 'bottomright';

    public function __construct(private readonly ControlId $controlId, private readonly string $name)
    {
    }

    #[Override]
    public function controlId(): ControlId
    {
        return $this->controlId;
    }

    public function name(): string
    {
        return $this->name;
    }

    #[Override]
    public function addTo(Map $map): void
    {
        $map->controls()->add($this);
    }

    /** @return array<string, Constraint> */
    #[Override]
    protected function optionConstraints(): array
    {
        return [
            'position' => EnumConstraint::withDefaultValue(
                [
                    self::POSITION_BOTTOM_LEFT,
                    self::POSITION_BOTTOM_RIGHT,
                    self::POSITION_TOP_LEFT,
                    self::POSITION_TOP_RIGHT,
                ],
                $this->defaultPosition(),
            ),
        ];
    }

    abstract protected function defaultPosition(): string|null;
}
