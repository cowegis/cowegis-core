<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

/** @template T */
interface Serializer
{
    /** @param T $data */
    public function serialize(mixed $data): mixed;
}
