<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use ArrayObject;

use function assert;
use function is_array;
use function is_object;

/** @extends DataSerializer<array|ArrayObject> */
final class ArraySerializer extends DataSerializer
{
    /**
     * @param ArrayObject|array<array-key,mixed>|mixed $data
     *
     * @return ArrayObject|array<array-key,mixed>
     */
    public function serialize($data)
    {
        assert(is_array($data) || $data instanceof ArrayObject);

        foreach ($data as $key => $value) {
            if (! is_object($value) && ! is_array($value)) {
                continue;
            }

            /**
             * @psalm-var mixed
             * @psalm-suppress MixedArrayOffset
             */
            $data[$key] = $this->serializer->serialize($value);
        }

        return $data;
    }
}
