<?php

declare(strict_types=1);

namespace Cowegis\Core\IdFormat;

use Cowegis\Core\Definition\DefinitionId;

/**
 * @template T of DefinitionId
 */
interface IdFormat
{
    /**
     * @param mixed $value
     * @psalm-param class-string<T> $definitionClass
     *
     * @return T
     */
    public function createDefinitionId(string $definitionClass, $value): DefinitionId;

    /** @param mixed $value */
    public function supports($value): bool;
}
