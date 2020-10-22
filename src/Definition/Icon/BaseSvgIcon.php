<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Icon;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\EnumConstraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Point;
use Cowegis\Core\Definition\SimpleStyle\SimpleStyleMarker;

use function assert;
use function is_string;

abstract class BaseSvgIcon extends BaseIcon implements SimpleStyleMarker
{
    public function markerSize(): ?string
    {
        $value = $this->options()->get('size');
        assert($value === null || is_string($value));

        return $value;
    }

    public function markerColor(): ?string
    {
        $value = $this->options()->get('bgColor');
        assert($value === null || is_string($value));

        return $value;
    }

    public function symbolColor(): ?string
    {
        $value = $this->options()->get('color');
        assert($value === null || is_string($value));

        return $value;
    }

    public function markerSymbol(): ?string
    {
        return null;
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
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
