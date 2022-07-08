<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use ArrayObject;
use Cowegis\Core\Definition\Options;

use function assert;
use function is_array;
use function is_object;

final class OptionsSerializer extends DataSerializer
{
    /**
     * @param Options|mixed $options
     */
    public function serialize($options): ArrayObject
    {
        assert($options instanceof Options);

        $data = new ArrayObject($options->toArray());

        foreach ($data as $key => $value) {
            if (! is_object($value) && ! is_array($value)) {
                continue;
            }

            /** @psalm-suppress MixedAssignment */
            $data[$key] = $this->serializer->serialize($value);
        }

        return $data;
    }
}
