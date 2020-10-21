<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Event;

use Cowegis\Core\Definition\Expression\Expression;
use Cowegis\Core\Definition\Expression\Reference;
use JsonSerializable;

use function array_map;

/**
 * @psalm-import-type TSerializedReference from \Cowegis\Core\Definition\Expression\Reference
 * @psalm-type TSerializedEvent = array{eventName: string, reference: TSerializedReference }
 * @psalm-type TEvent = array{eventName: string, reference: Reference }
*/
final class Events implements JsonSerializable
{
    /**
     * @var array<int, array<string, mixed>>
     * @psalm-var list<TEvent>
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
     * @psalm-return list<TSerializedEvent>
     */
    public function jsonSerialize(): array
    {
        return array_map(
            /**
             * @param array<int, array<string, mixed>> $listener
             *
             * @psalm-param TEvent $listener
             * @psalm-return TSerializedEvent
             */
            static function (array $listener): array {
                $listener['reference'] = $listener['reference']->jsonSerialize();

                return $listener;
            },
            $this->listeners
        );
    }
}
