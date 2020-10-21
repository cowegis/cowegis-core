<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use ArrayAccess;
use ArrayObject;

use function is_array;
use function is_object;

final class ArraySerializer extends DataSerializer
{
    /**
     * @param array<string,mixed>|ArrayObject|ArrayAccess $data
     *
     * @return array<string,mixed>|ArrayObject|ArrayAccess
     */
    public function serialize($data)
    {
        foreach ($data as $key => $value) {
            if (! is_object($value) && ! is_array($value)) {
                continue;
            }

            $data[$key] = $this->serializer->serialize($value);
        }

        return $data;
    }
}
