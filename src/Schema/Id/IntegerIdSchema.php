<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Id;

use Cowegis\Core\Schema\IdSchema;

final class IntegerIdSchema extends IdSchema
{
    public function __construct(string|null $objectId = null)
    {
        parent::__construct($objectId ?: 'id');

        $this->type    = 'integer';
        $this->format  = 'int32';
        $this->minimum = 0;
        $this->example = 123;
    }
}
