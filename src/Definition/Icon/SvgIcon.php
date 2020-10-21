<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Icon;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\StringConstraint;

final class SvgIcon extends BaseSvgIcon
{
    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['html'] = StringConstraint::withDefaultValue('');

        return $constraints;
    }
}
