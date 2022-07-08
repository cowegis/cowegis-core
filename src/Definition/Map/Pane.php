<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Map;

use Cowegis\Core\Definition\Definition;
use JsonSerializable;

/**
 * @psalm-type TSerializedPane = array{
 *   paneId: mixed,
 *   name: string,
 *   zIndex: ?int,
 *   pointerEvents: string|null
 * }
 */
final class Pane implements Definition, JsonSerializable
{
    private string $name;

    private ?int $zIndex;

    private PaneId $definitionId;

    private ?string $pointerEvents;

    public function __construct(PaneId $definitionId, string $name, ?int $zIndex, ?string $pointerEvents)
    {
        $this->name          = $name;
        $this->zIndex        = $zIndex;
        $this->definitionId  = $definitionId;
        $this->pointerEvents = $pointerEvents;
    }

    public function paneId(): PaneId
    {
        return $this->definitionId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function zIndex(): ?int
    {
        return $this->zIndex;
    }

    public function pointerEvents(): ?string
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
