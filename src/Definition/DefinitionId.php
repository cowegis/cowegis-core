<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use JsonSerializable;

interface DefinitionId extends JsonSerializable
{
    public static function fromValue($value): self;

    public function value();
}
