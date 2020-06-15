<?php

declare(strict_types=1);

namespace Cowegis\Core\IdFormat;

use Cowegis\Core\Definition\DefinitionId;

interface IdFormat
{
    public function createDefinitionId(string $definitionClass, $value) : DefinitionId;

    public function supports($value) : bool;
}
