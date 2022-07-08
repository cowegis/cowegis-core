<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

abstract class DataSerializer implements Serializer
{
    protected Serializer $serializer;

    public function __construct(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }
}
