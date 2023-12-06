<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Cowegis\Core\Exception\RuntimeException;

use function gettype;
use function is_object;
use function sprintf;

final class InstanceOfConstraint extends BaseConstraint
{
    /** @param class-string $expectedClass */
    public function __construct(private readonly string $expectedClass, bool $required = false)
    {
        parent::__construct($required);
    }

    /** @param class-string $expectedClass */
    public static function withDefaultValue(string $expectedClass, mixed $defaultValue): Constraint
    {
        return new DefaultValueConstraint(new self($expectedClass), $defaultValue);
    }

    public function match(mixed $value): bool
    {
        return $value instanceof $this->expectedClass;
    }

    public function filter(mixed $value): mixed
    {
        if ($this->match($value)) {
            return $value;
        }

        throw new RuntimeException(
            sprintf(
                'Invalid value given. Expected value be an instance of "%s", but "%s" given.',
                $this->expectedClass,
                is_object($value) ? $value::class : gettype($value),
            ),
        );
    }
}
