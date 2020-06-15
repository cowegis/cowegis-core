<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Icon;

use Cowegis\Core\Constraint\EnumConstraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Point;
use Cowegis\Core\Definition\SimpleStyle\SimpleStyleMarker;

abstract class BaseSvgIcon extends BaseIcon implements SimpleStyleMarker
{
    public function markerSize() : ?string
    {
        return $this->options()->get('size');
    }

    public function markerColor() : ?string
    {
        return $this->options()->get('bgColor');
    }

    public function symbolColor() : ?string
    {
        return $this->options()->get('color');
    }

    public function markerSymbol() : ?string
    {
        return null;
    }

    protected function optionConstraints() : array
    {
        $constraints = parent::optionConstraints();

        $constraints['iconSize']         = new InstanceOfConstraint(Point::class);
        $constraints['extraIconClasses'] = StringConstraint::withDefaultValue('');
        $constraints['extraDivClasses']  = StringConstraint::withDefaultValue('');
        $constraints['bgColor']          = StringConstraint::withDefaultValue('#80c22a');
        $constraints['color']            = StringConstraint::withDefaultValue('#ffffff');
        $constraints['size']             = EnumConstraint::withDefaultValue(['small', 'medium', 'large'], 'medium');
        $constraints['pinViewBox']       = new StringConstraint();
        $constraints['pinPath']          = new StringConstraint();

        return $constraints;
    }
}
