<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Definition\Control\ControlId;

interface Control extends Definition, HasTitle, HasOptions, MapObject
{
    public function controlId(): ControlId;
}
