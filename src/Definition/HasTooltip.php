<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Definition\UI\Tooltip;

interface HasTooltip
{
    public function tooltip(): Tooltip|null;

    public function showTooltip(Tooltip $tooltip): void;
}
