<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

/**
 * @template T
 */
interface Serializer
{
    /**
     * @param T $data
     *
     * @return mixed
     */
    public function serialize($data);
}
