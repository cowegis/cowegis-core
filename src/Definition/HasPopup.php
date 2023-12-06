<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Cowegis\Core\Definition\UI\Popup;

interface HasPopup
{
    public function popup(): Popup|null;

    public function openPopup(Popup $popup): void;
}
