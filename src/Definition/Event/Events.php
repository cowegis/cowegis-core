<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Event;

use Cowegis\Core\Definition\Expression\Expression;
use Cowegis\Core\Definition\Expression\Reference;
use JsonSerializable;

/**
 * @psalm-import-type TSerializedReference from \Cowegis\Core\Definition\Expression\Reference
 * @psalm-type TEvent = array{eventName: string, reference: TSerializedReference }
*/
final class Events implements JsonSerializable
{
    /**
     * @psalm-var list<TEvent>
     * @var array<int, array<string, mixed>
     */
    private $listeners = [];

    /** @SuppressWarnings(PHPMD.ShortMethodName) */
    public function on(string $eventName, Reference $reference): self
    {
        $this->listeners[] = [
            'eventName' => $eventName,
            'reference' => $reference,
        ];

        return $this;
    }

    /**
     * Get all listeners grouped by event name.
     *
     * @return Expression[][]
     *
     * @psalm-return list<TEvent>
     */
    public function listeners(): array
    {
        return $this->listeners;
    }

    /**
     * @return array<int, array<string,mixed>>
     *
     * @psalm-return list<TEvent>
     */
    public function jsonSerialize(): array
    {
        return $this->listeners;
    }
}
