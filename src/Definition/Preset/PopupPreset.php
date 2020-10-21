<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Preset;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Definition;
use Cowegis\Core\Definition\HasOptions;
use Cowegis\Core\Definition\Map\PaneId;
use Cowegis\Core\Definition\OptionsPlugin;
use Cowegis\Core\Definition\Point;
use Cowegis\Core\Definition\UI\PopupOptionsPlugin;

final class PopupPreset implements Definition, HasOptions
{
    use OptionsPlugin;
    use PopupOptionsPlugin;

    /** @var PopupPresetId */
    private $popupPresetId;

    public function __construct(PopupPresetId $popupPresetId)
    {
        $this->popupPresetId = $popupPresetId;
    }

    public function popupPresetId(): PopupPresetId
    {
        return $this->popupPresetId;
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = [
            'attribution' => new StringConstraint(),
            'offset'      => InstanceOfConstraint::withDefaultValue(Point::class, new Point(0, 7)),
            'className'   => StringConstraint::withDefaultValue(''),
            'pane'        => InstanceOfConstraint::withDefaultValue(PaneId::class, 'popupPane'),
        ];

        return $this->popupOptionsConstraints($constraints);
    }
}
