<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Definition\UI\Popup;

trait PopupPlugin
{
    private ?Popup $popup = null;

    public function popup(): ?Popup
    {
        return $this->popup;
    }

    public function openPopup(Popup $popup): void
    {
        $this->popup = $popup;
    }
}
