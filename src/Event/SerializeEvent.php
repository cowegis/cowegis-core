<?php

declare(strict_types=1);

namespace Cowegis\Core\Event;

final class SerializeEvent
{
    /** @var mixed */
    private $data;

    /** @var mixed */
    private $serialized;

    public function __construct($data, $serialized)
    {
        $this->data       = $data;
        $this->serialized = $serialized;
    }

    public function data()
    {
        return $this->data;
    }

    public function serialized()
    {
        return $this->serialized;
    }

    public function changeSerialized($serialized) : void
    {
        $this->serialized = $serialized;
    }
}
