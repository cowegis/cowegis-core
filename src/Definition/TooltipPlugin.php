<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Definition\UI\Tooltip;

trait TooltipPlugin
{
    /** @var Tooltip|null */
    private $tooltip;

    public function tooltip() : ?Tooltip
    {
        return $this->tooltip;
    }

    public function showTooltip(Tooltip $tooltip) : void
    {
        $this->tooltip = $tooltip;
    }
}
