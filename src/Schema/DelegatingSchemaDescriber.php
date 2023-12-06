<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

final class DelegatingSchemaDescriber implements SchemaDescriber
{
    /** @var SchemaDescriber[] */
    private array $describers = [];

    /** @param SchemaDescriber[] $describers */
    public function __construct(iterable $describers)
    {
        foreach ($describers as $describer) {
            $this->describers[] = $describer;
        }
    }

    public function describe(SchemaBuilder $builder): void
    {
        foreach ($this->describers as $describer) {
            $describer->describe($builder);
        }
    }
}
