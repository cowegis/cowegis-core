<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Cowegis\Core\Exception\RuntimeException;

use function get_class;
use function gettype;
use function is_array;

final class ListConstraint extends BaseConstraint
{
    public function __construct(private readonly Constraint $constraint, bool $required = false)
    {
        parent::__construct($required);
    }

    /** @return array<int, mixed> */
    public function defaultValue(): array
    {
        return [];
    }

    public function match(mixed $value): bool
    {
        if (! is_array($value)) {
            return false;
        }

        $index = 0;

        /** @psalm-var mixed $item */
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

    /** @return array<array-key, mixed> */
    public function filter(mixed $value): array
    {
        if (! is_array($value)) {
            throw new RuntimeException('Values has to be an array, given ' . gettype($value));
        }

        $index = 0;

        /** @psalm-var mixed $item */
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
