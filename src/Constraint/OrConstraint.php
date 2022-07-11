<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

final class OrConstraint extends BaseConstraint
{
    /** @var Constraint[] */
    private array $constraints = [];

    /**
     * @param Constraint[] $constraints
     */
    public function __construct(iterable $constraints, bool $required = false)
    {
        parent::__construct($required);

        foreach ($constraints as $constraint) {
            $this->constraints[] = $constraint;
        }
    }

    /** @param mixed $defaultValue */
    public static function withDefaultValue($defaultValue, Constraint ...$constraints): Constraint
    {
        return new DefaultValueConstraint(new self($constraints), $defaultValue);
    }

    public static function asRequired(Constraint ...$constraints): self
    {
        return new self($constraints, true);
    }

    /**
     * @param mixed $defaultValue
     * @param mixed $value
     */
    public static function valueOr($defaultValue, $value, Constraint ...$constraints): Constraint
    {
        return self::withDefaultValue($defaultValue, new EnumConstraint([$value]), ...$constraints);
    }

    /** {@inheritDoc} */
    public function match($value): bool
    {
        foreach ($this->constraints as $constraint) {
            if ($constraint->match($value)) {
                return true;
            }
        }

        return false;
    }

    /** {@inheritDoc} */
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
