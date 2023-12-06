<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

final class OrConstraint extends BaseConstraint
{
    /** @var Constraint[] */
    private array $constraints = [];

    /** @param Constraint[] $constraints */
    public function __construct(iterable $constraints, bool $required = false)
    {
        parent::__construct($required);

        foreach ($constraints as $constraint) {
            $this->constraints[] = $constraint;
        }
    }

    public static function withDefaultValue(mixed $defaultValue, Constraint ...$constraints): Constraint
    {
        return new DefaultValueConstraint(new self($constraints), $defaultValue);
    }

    public static function asRequired(Constraint ...$constraints): self
    {
        return new self($constraints, true);
    }

    public static function valueOr(mixed $defaultValue, mixed $value, Constraint ...$constraints): Constraint
    {
        return self::withDefaultValue($defaultValue, new EnumConstraint([$value]), ...$constraints);
    }

    public function match(mixed $value): bool
    {
        foreach ($this->constraints as $constraint) {
            if ($constraint->match($value)) {
                return true;
            }
        }

        return false;
    }

    public function filter(mixed $value): mixed
    {
        foreach ($this->constraints as $constraint) {
            if ($constraint->match($value)) {
                return $constraint->filter($value);
            }
        }

        return $value;
    }
}
