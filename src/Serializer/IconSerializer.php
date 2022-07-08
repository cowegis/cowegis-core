<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Icon\Icon;

use function assert;

/**
 * @psalm-type TSerializedIcon = array{
 *   iconId: mixed,
 *   type: string,
 *   options: array<string, mixed>
 * }
 */
final class IconSerializer extends DataSerializer
{
    /** @var string */
    protected $type;

    public function __construct(string $type, Serializer $serializer)
    {
        parent::__construct($serializer);

        $this->type = $type;
    }

    /**
     * @param Icon|mixed $data
     *
     * @return array<string,mixed>
     * @psalm-return TSerializedIcon
     */
    public function serialize($data): array
    {
        assert($data instanceof Icon);

        /** @psalm-var array<string,mixed> $options */
        $options = $this->serializer->serialize($data->options());

        return [
            'iconId'  => $data->iconId()->value(),
            'type'    => $this->type,
            'options' => $options,
        ];
    }
}
