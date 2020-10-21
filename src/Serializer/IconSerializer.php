<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Definition\Icon\Icon;

use function assert;

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
     * @param Icon $data
     *
     * @return array<string,mixed>
     *
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingNativeTypeHint
     */
    public function serialize($data): array
    {
        assert($data instanceof Icon);

        return [
            'iconId'  => $data->iconId()->value(),
            'type'    => $this->type,
            'options' => $this->serializer->serialize($data->options()),
        ];
    }
}
