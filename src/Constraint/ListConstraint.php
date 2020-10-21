<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Cowegis\Core\Exception\RuntimeException;

use function get_class;
use function gettype;
use function is_array;

final class ListConstraint extends BaseConstraint
{
    /** @var Constraint */
    private $constraint;

    public function __construct(Constraint $constraint, bool $required = false)
    {
        parent::__construct($required);

        $this->constraint = $constraint;
    }

    /** @return array<int, mixed> */
    public function defaultValue(): array
    {
        return [];
    }

    /** {@inheritDoc} */
    public function match($value): bool
    {
        if (! is_array($value)) {
            return false;
        }

        $index = 0;

        foreach ($value as $key => $item) {
            if ($key !== $index) {
                return false;
            }

            if (! $this->constraint->match($item)) {
                return false;
            }

            $index++;
        }

        return true;
    }

    /** {@inheritDoc} */
    public function filter($value)
    {
        if (! is_array($value)) {
            throw new RuntimeException('Values has to be an array, given ' . gettype($value));
        }

        $index = 0;

        foreach ($value as $key => $item) {
            if ($key !== $index) {
                throw new RuntimeException('Expected list but detected invalid array key ' . $key);
            }

            if (! $this->constraint->match($item)) {
                throw new RuntimeException('Value does not match exprected constraint ' . get_class($this->constraint));
            }

            $index++;
        }

        return $value;
    }
}
