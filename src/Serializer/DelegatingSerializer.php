<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

use Cowegis\Core\Exception\RuntimeException;
use JsonSerializable;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

use function get_class;
use function gettype;
use function is_object;

/** @implements Serializer<mixed> */
final class DelegatingSerializer implements Serializer
{
    private ContainerInterface $serializers;

    public function __construct(ContainerInterface $serializers)
    {
        $this->serializers = $serializers;
    }

    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function serialize($data)
    {
        try {
            return $this->determineSerializer($data)->serialize($data);
        } catch (NotFoundExceptionInterface $exception) {
        }

        if (! is_object($data)) {
            return $data;
        }

        if ($data instanceof JsonSerializable) {
            return $data->jsonSerialize();
        }

        throw new RuntimeException('Serializing data failed');
    }

    /**
     * @param mixed $data
     *
     * @psalm-suppress MixedInferredReturnType
     */
    private function determineSerializer($data): Serializer
    {
        if (is_object($data) && $this->serializers->has(get_class($data))) {
            /** @psalm-suppress MixedReturnStatement: */
            return $this->serializers->get(get_class($data));
        }

        /** @psalm-suppress MixedReturnStatement: */
        return $this->serializers->get(gettype($data));
    }
}
