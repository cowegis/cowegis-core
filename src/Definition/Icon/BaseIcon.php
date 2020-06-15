<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Icon;

use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\OptionsPlugin;
use Cowegis\Core\Definition\Point;

abstract class BaseIcon implements Icon
{
    use OptionsPlugin;

    /** @var IconId */
    private $iconId;

    public function __construct(IconId $iconId)
    {
        $this->iconId = $iconId;
    }

    public function iconId() : IconId
    {
        return $this->iconId;
    }

    protected function optionConstraints() : array
    {
        return [
            'iconAnchor'    => new InstanceOfConstraint(Point::class),
            'popupAnchor'   => InstanceOfConstraint::withDefaultValue(Point::class, new Point(0, 0)),
            'tooltipAnchor' => InstanceOfConstraint::withDefaultValue(Point::class, new Point(0, 0)),
            'className'     => StringConstraint::withDefaultValue(''),
        ];
    }
}
