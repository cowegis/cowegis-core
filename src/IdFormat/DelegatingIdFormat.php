<?php

declare(strict_types=1);

namespace Cowegis\Core\IdFormat;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Exception\InvalidArgument;

final class DelegatingIdFormat implements IdFormat
{
    /** @var IdFormat[] */
    private $idFormats;

    public function __construct(iterable $idFormats)
    {
        $this->idFormats = $idFormats;
    }

    public function createDefinitionId(string $definitionClass, $value) : DefinitionId
    {
        foreach ($this->idFormats as $idFormat) {
            if ($idFormat->supports($value)) {
                return $idFormat->createDefinitionId($definitionClass, $value);
            }
        }

        throw new InvalidArgument($value);
    }

    public function supports($value) : bool
    {
        foreach ($this->idFormats as $idFormat) {
            if ($idFormat->supports($value)) {
                return true;
            }
        }

        return false;
    }
}
