<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

interface HasOptions
{
    public function options(): Options;
}
