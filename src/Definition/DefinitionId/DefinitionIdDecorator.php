<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\DefinitionId;

use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Exception\RuntimeException;

abstract class DefinitionIdDecorator implements DefinitionId
{
    /** @var DefinitionId */
    private $definitionId;

    public function __construct(DefinitionId $definitionId)
    {
        $this->definitionId = $definitionId;
    }

    /**
     * @param $value
     *
     * @return static
     */
    public static function fromValue($value) : DefinitionId
    {
        if (! $value instanceof DefinitionId) {
            throw new RuntimeException('Given value must be an instance of ' . DefinitionId::class);
        }

        return new static($value);
    }

    public function inner(): DefinitionId
    {
        return $this->definitionId;
    }

    public function value()
    {
        return $this->definitionId->value();
    }

    public function jsonSerialize()
    {
        return $this->definitionId->jsonSerialize();
    }
}
