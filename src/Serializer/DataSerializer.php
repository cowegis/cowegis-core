<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

/**
 * @template T
 * @implements Serializer<T>
 */
abstract class DataSerializer implements Serializer
{
    public function __construct(protected readonly Serializer $serializer)
    {
    }
}
