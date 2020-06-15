<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use function in_array;

final class EnumConstraint extends BaseConstraint
{
    /** @var array */
    private $values;

    public function __construct(array $values, bool $required = false)
    {
        parent::__construct($required);

        $this->values   = $values;
    }

    public static function withDefaultValue(array $values, $defaultValue) : Constraint
    {
        return new DefaultValueConstraint(new self($values), $defaultValue);
    }

    public static function asRequired(array $values) : Constraint
    {
        return new self($values, true);
    }

    public function match($value) : bool
    {
        return in_array($value, $this->values, true);
    }

    public function filter($value)
    {
        foreach ($this->values as $allowed) {
            if ($allowed == $value) {
                return $allowed;
            }
        }

        return null;
    }
}
