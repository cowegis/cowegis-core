<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Exception\InvalidArgument;

use function is_array;
use function is_string;

/** @psalm-import-type TRawLatLng from LatLng */
final class LatLngConstraint extends ConstraintWithDefault
{
    public function match(mixed $value): bool
    {
        try {
            /** @psalm-suppress MixedArgument */
            $this->createFromValue($value);
        } catch (InvalidArgument) {
            return false;
        }

        return true;
    }

    public function filter(mixed $value): LatLng
    {
        if ($value instanceof LatLng) {
            return $value;
        }

        if (is_string($value) || is_array($value)) {
            /** @psalm-suppress MixedArgumentTypeCoercion */
            return $this->createFromValue($value);
        }

        throw new InvalidArgument('Could not create instance');
    }

    /** @param TRawLatLng|string $value */
    private function createFromValue(array|string $value): LatLng
    {
        if (is_array($value)) {
            /** @psalm-suppress MixedArgumentTypeCoercion */
            return LatLng::fromArray($value);
        }

        return LatLng::fromString($value);
    }
}
