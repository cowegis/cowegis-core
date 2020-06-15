<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use function is_array;
use function is_object;

final class ArraySerializer extends DataSerializer
{
    public function serialize($data)
    {
        foreach ($data as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $data[$key] = $this->serializer->serialize($value);
            }
        }

        return $data;
    }
}
