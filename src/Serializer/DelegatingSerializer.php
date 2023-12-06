<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Exception\RuntimeException;
use JsonSerializable;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function gettype;
use function is_object;

/** @implements Serializer<mixed> */
final class DelegatingSerializer implements Serializer
{
    public function __construct(private readonly ContainerInterface $serializers)
    {
    }

    /** {@@inheritDoc} */
    public function serialize(mixed $data): mixed
    {
        try {
            return $this->determineSerializer($data)->serialize($data);
        } catch (NotFoundExceptionInterface) {
        }

        if (! is_object($data)) {
            return $data;
        }

        if ($data instanceof JsonSerializable) {
            return $data->jsonSerialize();
        }

        throw new RuntimeException('Serializing data failed');
    }

    /** @psalm-suppress MixedInferredReturnType */
    private function determineSerializer(mixed $data): Serializer
    {
        if (is_object($data) && $this->serializers->has($data::class)) {
            /** @psalm-suppress MixedReturnStatement: */
            return $this->serializers->get($data::class);
        }

        /** @psalm-suppress MixedReturnStatement: */
        return $this->serializers->get(gettype($data));
    }
}
