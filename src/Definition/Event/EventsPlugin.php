<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Event;

trait EventsPlugin
{
    /**
     * @var Events
     * @psalm-suppress PropertyNotSetInConstructor - Property may not be accessed directly
     */
    private $events;

    public function events(): Events
    {
        /** @psalm-suppress DocblockTypeContradiction */
        if ($this->events === null) {
            $this->events = new Events();
        }

        return $this->events;
    }
}
