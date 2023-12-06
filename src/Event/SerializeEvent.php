<?php

declare(strict_types=1);

namespace Cowegis\Core\Event;

final class SerializeEvent
{
    public function __construct(private readonly mixed $data, private mixed $serialized)
    {
    }

    public function data(): mixed
    {
        return $this->data;
    }

    public function serialized(): mixed
    {
        return $this->serialized;
    }

    public function changeSerialized(mixed $serialized): void
    {
        $this->serialized = $serialized;
    }
}
