<?php

declare(strict_types=1);

namespace Cowegis\Core\IdFormat;

use Cowegis\Core\Definition\DefinitionId;

/** @template T of DefinitionId */
interface IdFormat
{
    /**
     * @psalm-param class-string<T> $definitionClass
     *
     * @return T
     */
    public function createDefinitionId(string $definitionClass, mixed $value): DefinitionId;

    public function supports(mixed $value): bool;
}
