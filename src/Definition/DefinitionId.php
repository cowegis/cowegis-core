<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use JsonSerializable;

interface DefinitionId extends JsonSerializable
{
    /** @param mixed $value */
    public static function fromValue($value): self;

    /** @return mixed */
    public function value() : string;
}
