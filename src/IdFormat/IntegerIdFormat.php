<?php

declare(strict_types=1);

namespace Cowegis\Core\IdFormat;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Definition\DefinitionId\IntegerDefinitionId;

use function is_int;
use function is_numeric;
use function is_string;
use function strpos;

/**
 * @template T of DefinitionId
 * @implements IdFormat<T>
 */
final class IntegerIdFormat implements IdFormat
{
    /**
     * {@inheritDoc}
     *
     * @psalm-suppress MixedInferredReturnType
     * @psalm-suppress MixedMethodCall
     * @psalm-suppress MixedReturnStatement
     */
    public function createDefinitionId(string $definitionClass, mixed $value): DefinitionId
    {
        if ($this->supports($value)) {
            $value = (int) $value;
        }

        return $definitionClass::fromValue(IntegerDefinitionId::fromValue($value));
    }

    public function supports(mixed $value): bool
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
