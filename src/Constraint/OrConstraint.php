<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

final class OrConstraint extends BaseConstraint
{
    private $constraints;

    public function __construct($constraints, bool $required = false)
    {
        parent::__construct($required);

        $this->constraints = $constraints;
    }

    public static function withDefaultValue($defaultValue, Constraint ...$constraints) : Constraint
    {
        return new DefaultValueConstraint(new self($constraints), $defaultValue);
    }

    public static function asRequired(Constraint ...$constraints) : self
    {
        return new self($constraints, true);
    }

    public static function valueOr($defaultValue, $value, Constraint ...$constraints): Constraint
    {
        return self::withDefaultValue($defaultValue, new EnumConstraint([$value]), ...$constraints);
    }

    public function match($value) : bool
    {
        foreach ($this->constraints as $constraint) {
            if ($constraint->match($value)) {
                return true;
            }
        }

        return false;
    }

    public function filter($value)
    {
        foreach ($this->constraints as $constraint) {
            if ($constraint->match($value)) {
                return $constraint->filter($value);
            }
        }

        return $value;
    }
}
