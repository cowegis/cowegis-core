<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Id;

use Cowegis\Core\Schema\IdSchema;

final class Uuid4IdSchema extends IdSchema
{
    public function __construct(string|null $objectId = null)
    {
        parent::__construct($objectId ?: 'id');

        $this->type    = 'string';
        $this->format  = 'uuid';
        $this->example = '604b4118-e73a-48e3-bd65-1d871ec84211';
    }
}
