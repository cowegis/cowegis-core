<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class HashMap extends Schema
{
    public function __construct(?string $objectId = null)
    {
        parent::__construct($objectId);

        $this->type = 'object';
        /** @psalm-suppress InvalidPropertyAssignmentValue */
        $this->additionalProperties = true;
    }
}
