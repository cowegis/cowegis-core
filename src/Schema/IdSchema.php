<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

abstract class IdSchema extends Schema
{
    public const SHORT_REF = 'Id';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;
}
