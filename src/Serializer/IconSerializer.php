<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Icon\Icon;

/**
 * @extends DataSerializer<Icon>
 * @psalm-type TSerializedIcon = array{
 *   iconId: mixed,
 *   type: string,
 *   options: array<string, mixed>
 * }
 */
final class IconSerializer extends DataSerializer
{
    public function __construct(protected readonly string $type, Serializer $serializer)
    {
        parent::__construct($serializer);
    }

    /**
     * @param Icon $data
     *
     * @return array<string,mixed>
     * @psalm-return TSerializedIcon
     */
    public function serialize(mixed $data): array
    {
        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($data->options());

        return [
            'iconId'  => $data->iconId()->value(),
            'type'    => $this->type,
            'options' => $options,
        ];
    }
}
