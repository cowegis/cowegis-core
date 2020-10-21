<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Cowegis\Core\Exception\RuntimeException;

final class ValueConstraint extends BaseConstraint
{
    /** @var mixed */
    private $value;

    /** @param mixed $value */
    public function __construct($value, bool $required = false)
    {
        parent::__construct($required);

        $this->value = $value;
    }

    /** {@inheritDoc} */
    public function match($value): bool
    {
        return $this->value === $value;
    }

    /** {@inheritDoc} */
    public function filter($value)
    {
        if ($this->match($value)) {
            return $value;
        }

        throw new RuntimeException('Invalid value');
    }
}
