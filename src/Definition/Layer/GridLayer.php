<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\FloatConstraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\IntegerConstraint;
use Cowegis\Core\Constraint\NumberConstraint;
use Cowegis\Core\Constraint\OrConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\LatLngBounds;
use Cowegis\Core\Definition\Map\PaneId;
use Cowegis\Core\Definition\Point;

abstract class GridLayer extends Layer
{
    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['tileSize']          = OrConstraint::withDefaultValue(
            256,
            new IntegerConstraint(),
            new InstanceOfConstraint(Point::class),
        );
        $constraints['opacity']           = FloatConstraint::withDefaultValue(1.0);
        $constraints['updateWhenIdle']    = BooleanConstraint::withDefaultValue(null);
        $constraints['updateWhenZooming'] = BooleanConstraint::withDefaultValue(true);
        $constraints['updateInterval']    = IntegerConstraint::withDefaultValue(200);
        $constraints['zIndex']            = IntegerConstraint::withDefaultValue(1);
        $constraints['bounds']            = new InstanceOfConstraint(LatLngBounds::class);
        $constraints['minZoom']           = NumberConstraint::withDefaultValue(0);
        $constraints['maxZoom']           = new NumberConstraint();
        $constraints['maxNativeZoom']     = new NumberConstraint();
        $constraints['minNativeZoom']     = new NumberConstraint();
        $constraints['noWrap']            = BooleanConstraint::withDefaultValue(false);
        $constraints['pane']              = new InstanceOfConstraint(PaneId::class);
        $constraints['GridLayer']         = StringConstraint::withDefaultValue('');
        $constraints['keepBuffer']        = IntegerConstraint::withDefaultValue(2);

        return $constraints;
    }
}
