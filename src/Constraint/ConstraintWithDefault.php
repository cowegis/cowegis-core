<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

abstract class ConstraintWithDefault extends BaseConstraint
{
    /** @param mixed $value */
    public static function withDefaultValue($value): Constraint
    {
        return new DefaultValueConstraint(new static(), $value);
    }

    public static function asRequired(): Constraint
    {
        return new static(true);
    }
}
