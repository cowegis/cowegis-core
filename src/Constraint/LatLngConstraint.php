<?php

declare(strict_types=1);

namespace Cowegis\Core\Constraint;

use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Exception\InvalidArgument;
use function is_array;
use function is_string;

final class LatLngConstraint extends ConstraintWithDefault
{
    public function match($value) : bool
    {
        try {
            $this->createFromValue($value);
        } catch (InvalidArgument $exception) {
            return false;
        }

        return true;
    }

    public function filter($value) : LatLng
    {
        return $this->createFromValue($value);
    }

    private function createFromValue($value): LatLng
    {
        if ($value instanceof LatLng) {
            return $value;
        }

        if (is_array($value)) {
            return LatLng::fromArray($value);
        }

        if (is_string($value)) {
            return LatLng::fromString($value);
        }

        throw new InvalidArgument('Could not create instance');
    }
}
