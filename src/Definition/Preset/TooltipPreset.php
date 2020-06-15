<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Preset;

use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Definition;
use Cowegis\Core\Definition\HasOptions;
use Cowegis\Core\Definition\Map\PaneId;
use Cowegis\Core\Definition\OptionsPlugin;
use Cowegis\Core\Definition\UI\TooltipOptionsPlugin;

final class TooltipPreset implements Definition, HasOptions
{
    use OptionsPlugin;
    use TooltipOptionsPlugin;

    /** @var TooltipPresetId */
    private $tooltipPresetId;

    public function __construct(TooltipPresetId $tooltipPresetId)
    {
        $this->tooltipPresetId = $tooltipPresetId;
    }

    public function tooltipPresetId() : TooltipPresetId
    {
        return $this->tooltipPresetId;
    }

    protected function optionConstraints() : array
    {
        $constraints = [
            'attribution' => new StringConstraint(),
            'className'   => StringConstraint::withDefaultValue(''),
            'pane'        => InstanceOfConstraint::withDefaultValue(PaneId::class, 'tooltipPane'),
        ];

        return $this->tooltipOptionsConstraints($constraints);
    }
}
