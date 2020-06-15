<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

interface SchemaDescriber
{
    public function describe(SchemaBuilder $builder) : void;
}
