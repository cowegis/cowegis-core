<?php

declare(strict_types=1);

namespace Cowegis\Core\IdFormat;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Exception\InvalidArgument;

/**
 * @template T of DefinitionId
 * @implements IdFormat<T>
 */
final class DelegatingIdFormat implements IdFormat
{
    /** @var IdFormat[] */
    private array $idFormats = [];

    /** @param IdFormat[] $idFormats */
    public function __construct(iterable $idFormats)
    {
        foreach ($idFormats as $idFormat) {
            $this->idFormats[] = $idFormat;
        }
    }

    /**
     * {@inheritDoc}
     *
     * @psalm-suppress InvalidReturnType
     * @psalm-suppress InvalidReturnStatement
     */
    public function createDefinitionId(string $definitionClass, mixed $value): DefinitionId
    {
        foreach ($this->idFormats as $idFormat) {
            if ($idFormat->supports($value)) {
                return $idFormat->createDefinitionId($definitionClass, $value);
            }
        }

        throw new InvalidArgument((string) $value);
    }

    public function supports(mixed $value): bool
    {
        foreach ($this->idFormats as $idFormat) {
            if ($idFormat->supports($value)) {
                return true;
            }
        }

        return false;
    }
}
