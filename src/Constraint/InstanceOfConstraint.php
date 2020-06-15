<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Cowegis\Core\Exception\RuntimeException;
use function get_class;
use function gettype;
use function is_object;

final class InstanceOfConstraint extends BaseConstraint
{
    /** @var string */
    private $expectedClass;

    public function __construct(string $expectedClass, bool $required = false)
    {
        parent::__construct($required);

        $this->expectedClass = $expectedClass;
    }

    public static function withDefaultValue(string $expectedClass, $defaultValue) : Constraint
    {
        return new DefaultValueConstraint(new self($expectedClass), $defaultValue);
    }

    public function match($value) : bool
    {
        return $value instanceof $this->expectedClass;
    }

    public function filter($value)
    {
        if ($this->match($value)) {
            return $value;
        }

        throw new RuntimeException(
            sprintf(
                'Invalid value given. Expected value be an instance of "%s", but "%s" given.',
                $this->expectedClass,
                is_object($value) ? get_class($value) : gettype($value)
            )
        );
    }
}
