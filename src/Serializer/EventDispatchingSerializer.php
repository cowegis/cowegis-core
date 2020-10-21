<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Event\SerializeEvent;
use Psr\EventDispatcher\EventDispatcherInterface;

final class EventDispatchingSerializer extends DataSerializer
{
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    public function __construct(Serializer $serializer, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($serializer);

        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function serialize($data)
    {
        /** @psalm-var mixed */
        $serialized = $this->serializer->serialize($data);
        $event      = new SerializeEvent($data, $serialized);

        $this->eventDispatcher->dispatch($event);

        return $event->serialized();
    }
}
