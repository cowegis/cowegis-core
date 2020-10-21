<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

interface HasTitle
{
    public function changeTitle(string $label): void;

    public function title(): ?string;
}
