<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Icon;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\EnumConstraint;
use Cowegis\Core\Constraint\StringConstraint;

use function assert;
use function is_string;

final class FontAwesomeIcon extends BaseSvgIcon
{
    public function markerSymbol(): string|null
    {
        $value = $this->options()->get('icon');
        assert($value === null || is_string($value));

        return $value;
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['icon']    = StringConstraint::withDefaultValue('circle');
        $constraints['iconSet'] = EnumConstraint::withDefaultValue(['solid', 'brands', 'regular'], 'solid');

        return $constraints;
    }
}
