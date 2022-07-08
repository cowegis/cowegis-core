<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Event;

trait EventsPlugin
{
    /** @psalm-suppress PropertyNotSetInConstructor - Property may not be accessed directly */
    private Events $events;

    public function events(): Events
    {
        /** @psalm-suppress TypeDoesNotContainType */
        if (! isset($this->events)) {
            $this->events = new Events();
        }

        return $this->events;
    }
}
