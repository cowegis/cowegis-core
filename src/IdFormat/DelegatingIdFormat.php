<?php

declare(strict_types=1);

namespace Cowegis\Core\IdFormat;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Exception\InvalidArgument;

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

    /** {@inheritDoc} */
    public function createDefinitionId(string $definitionClass, $value): DefinitionId
    {
        foreach ($this->idFormats as $idFormat) {
            if ($idFormat->supports($value)) {
                return $idFormat->createDefinitionId($definitionClass, $value);
            }
        }

        throw new InvalidArgument((string) $value);
    }

    /** {@inheritDoc} */
    public function supports($value): bool
    {
        foreach ($this->idFormats as $idFormat) {
            if ($idFormat->supports($value)) {
                return true;
            }
        }

        return false;
    }
}
