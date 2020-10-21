<?php

declare(strict_types=1);

namespace Cowegis\Core\Event;

final class SerializeEvent
{
    /** @var mixed */
    private $data;

    /** @var mixed */
    private $serialized;

    /**
     * @param mixed $data
     * @param mixed $serialized
     */
    public function __construct($data, $serialized)
    {
        $this->data       = $data;
        $this->serialized = $serialized;
    }

    /** @return mixed */
    public function data()
    {
        return $this->data;
    }

    /** @return mixed */
    public function serialized()
    {
        return $this->serialized;
    }

    /** @param mixed $serialized */
    public function changeSerialized($serialized): void
    {
        $this->serialized = $serialized;
    }
}
