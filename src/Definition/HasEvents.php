<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Definition\Event\Events;

interface HasEvents
{
    public function events(): Events;
}
