<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use ArrayObject;
use Cowegis\Core\Definition\Options;
use function is_array;
use function is_object;

final class OptionsSerializer extends DataSerializer
{
    /** @param Options $options */
    public function serialize($options)
    {
        $data = new ArrayObject($options->toArray());

        foreach ($data as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $data[$key] = $this->serializer->serialize($value);
            }
        }

        return $data;
    }
}
