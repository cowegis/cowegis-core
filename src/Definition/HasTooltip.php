<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Definition\UI\Popup;
use Cowegis\Core\Definition\UI\Tooltip;

interface HasTooltip
{
    public function tooltip() : ?Tooltip;

    public function showTooltip(Tooltip $popup) : void;
}
