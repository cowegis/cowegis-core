<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use ArrayObject;
use Cowegis\Core\Definition\Options;

use function is_array;
use function is_object;

/** @extends DataSerializer<Options> */
final class OptionsSerializer extends DataSerializer
{
    public function serialize(mixed $data): ArrayObject
    {
        $serialized = new ArrayObject($data->toArray());

        foreach ($serialized as $key => $value) {
            if (! is_object($value) && ! is_array($value)) {
                continue;
            }

            /** @psalm-suppress MixedAssignment */
            $serialized[$key] = $this->serializer->serialize($value);
        }

        return $serialized;
    }
}
