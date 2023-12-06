<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Map;

use Cowegis\Core\Definition\Definition;
use JsonSerializable;

/**
 * @psalm-type TSerializedPane = array{
 *   paneId: mixed,
 *   name: string,
 *   zIndex: int|null,
 *   pointerEvents: string|null
 * }
 */
final class Pane implements Definition, JsonSerializable
{
    public function __construct(
        private readonly PaneId $definitionId,
        private readonly string $name,
        private readonly int|null $zIndex,
        private readonly string|null $pointerEvents,
    ) {
    }

    public function paneId(): PaneId
    {
        return $this->definitionId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function zIndex(): int|null
    {
        return $this->zIndex;
    }

    public function pointerEvents(): string|null
    {
        return $this->pointerEvents;
    }

    /**
     * @return array<string,mixed>
     * @psalm-return TSerializedPane
     */
    public function jsonSerialize(): array
    {
        return [
            'paneId'        => $this->paneId()->value(),
            'name'          => $this->name(),
            'zIndex'        => $this->zIndex(),
            'pointerEvents' => $this->pointerEvents(),
        ];
    }
}
