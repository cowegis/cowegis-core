<?php

declare(strict_types=1);

namespace Cowegis\Core\IdFormat;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Definition\DefinitionId\IntegerDefinitionId;

use function is_int;
use function is_numeric;
use function is_string;
use function strpos;

final class IntegerIdFormat implements IdFormat
{
    /** {@inheritDoc} */
    public function createDefinitionId(string $definitionClass, $value): DefinitionId
    {
        if ($this->supports($value)) {
            $value = (int) $value;
        }

        return $definitionClass::fromValue(IntegerDefinitionId::fromValue($value));
    }

    /** {@inheritDoc} */
    public function supports($value): bool
    {
        if (is_int($value)) {
            return true;
        }

        if (! is_string($value)) {
            return false;
        }

        return is_numeric($value) && strpos($value, '.') === false;
    }
}
