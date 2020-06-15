<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Event;

use Cowegis\Core\Definition\Expression\Expression;
use Cowegis\Core\Definition\Expression\Reference;
use JsonSerializable;

final class Events implements JsonSerializable
{
    /**
     * @psalm-var array<string, list<Expression>>
     *
     * @var array[]
     */
    private $listeners = [];

    public function on(string $eventName, Reference $reference) : self
    {
        $this->listeners[] = [
            'eventName' => $eventName,
            'reference' => $reference
        ];

        return $this;
    }

    /**
     * Get all listeners grouped by event name.
     *
     * @psalm-return array<string, list<Expression>>
     *
     * @return Expression[][]
     */
    public function listeners() : array
    {
        return $this->listeners;
    }

    public function jsonSerialize() : array
    {
        return $this->listeners;
    }
}
