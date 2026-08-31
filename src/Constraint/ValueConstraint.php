<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Cowegis\Core\Exception\RuntimeException;
use Override;

final class ValueConstraint extends BaseConstraint
{
    public function __construct(private readonly mixed $value, bool $required = false)
    {
        parent::__construct($required);
    }

    #[Override]
    public function match(mixed $value): bool
    {
        return $this->value === $value;
    }

    #[Override]
    public function filter(mixed $value): mixed
    {
        if ($this->match($value)) {
            return $value;
        }

        throw new RuntimeException('Invalid value');
    }
}
