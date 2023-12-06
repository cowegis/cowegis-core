<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Definition\UI\Tooltip;

trait TooltipPlugin
{
    private Tooltip|null $tooltip = null;

    public function tooltip(): Tooltip|null
    {
        return $this->tooltip;
    }

    public function showTooltip(Tooltip $tooltip): void
    {
        $this->tooltip = $tooltip;
    }
}
