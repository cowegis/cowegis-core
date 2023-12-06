<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Event\SerializeEvent;
use Psr\EventDispatcher\EventDispatcherInterface;

/** @extends DataSerializer<mixed> */
final class EventDispatchingSerializer extends DataSerializer
{
    public function __construct(Serializer $serializer, private readonly EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($serializer);
    }

    /** {@inheritDoc} */
    public function serialize(mixed $data): mixed
    {
        /** @psalm-var mixed */
        $serialized = $this->serializer->serialize($data);
        $event      = new SerializeEvent($data, $serialized);

        $this->eventDispatcher->dispatch($event);

        return $event->serialized();
    }
}
