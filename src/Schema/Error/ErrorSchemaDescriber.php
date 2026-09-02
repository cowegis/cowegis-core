<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Error;

use Cowegis\Core\Schema\SchemaBuilder;
use Cowegis\Core\Schema\SchemaDescriber;
use Override;

final class ErrorSchemaDescriber implements SchemaDescriber
{
    #[Override]
    public function describe(SchemaBuilder $builder): void
    {
        $builder->components()->withSchema(new ErrorSchema());
    }
}
