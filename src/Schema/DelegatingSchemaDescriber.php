<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

final class DelegatingSchemaDescriber implements SchemaDescriber
{
    /** @var SchemaDescriber[] */
    private $builders;

    /**
     * @param SchemaDescriber[] $builders
     */
    public function __construct(iterable $builders)
    {
        $this->builders = $builders;
    }

    public function describe(SchemaBuilder $builder): void
    {
        foreach ($this->builders as $schemaBuilder) {
            $schemaBuilder->describe($builder);
        }
    }
}
