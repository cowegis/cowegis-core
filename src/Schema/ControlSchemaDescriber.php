<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;

abstract class ControlSchemaDescriber
{
    abstract public function describe(SchemaBuilder $specificationBuilder) : SchemaContract;
}
