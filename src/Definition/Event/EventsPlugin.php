<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Event;

trait EventsPlugin
{
    /** @var Events */
    private $events;

    public function events(): Events
    {
        if ($this->events === null) {
            $this->events = new Events();
        }

        return $this->events;
    }
}
