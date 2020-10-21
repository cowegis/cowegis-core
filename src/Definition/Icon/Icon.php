<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Icon;

use Cowegis\Core\Definition\Definition;
use Cowegis\Core\Definition\HasOptions;

interface Icon extends Definition, HasOptions
{
    public function iconId(): IconId;
}
