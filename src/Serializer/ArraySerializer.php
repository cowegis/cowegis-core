<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use function assert;
use function is_array;
use function is_object;

final class ArraySerializer extends DataSerializer
{
    /**
     * @param array<array-key,mixed>|mixed $data
     *
     * @return array<array-key,mixed>
     */
    public function serialize($data): array
    {
        assert(is_array($data));

        foreach ($data as $key => $value) {
            if (! is_object($value) && ! is_array($value)) {
                continue;
            }

            /** @psalm-var mixed */
            $data[$key] = $this->serializer->serialize($value);
        }

        return $data;
    }
}
