<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

interface Compareable
{
    public function equals(Compareable $other) : bool;
}
