<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

use function array_merge;
use function ucfirst;

abstract class ControlSchemaDescriber
{
    public function __construct(private readonly string $controlType)
    {
    }

    /**
     * @return Schema[]
     * @psalm-return list<Schema>
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) - Implementations might need the schema builder
     */
    protected function requiredProperties(SchemaBuilder $builder): array
    {
        return [];
    }

    /**
     * @return Schema[]
     * @psalm-return list<Schema>
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) - Implementations might need the schema builder
     */
    protected function optionalProperties(SchemaBuilder $builder): array
    {
        return [];
    }

    /** @SuppressWarnings(PHPMD.UnusedFormalParameter) - Implementations might need the parameters */
    protected function registerRequirements(SchemaBuilder $builder, Schema $schema): void
    {
    }

    final public function describe(SchemaBuilder $builder): SchemaContract
    {
        $requiredProperties = $this->requiredProperties($builder);
        $optionalProperties = $this->optionalProperties($builder);
        $properties         = array_merge($requiredProperties, $optionalProperties);

        $schema = Schema::object()
            ->title('Control type ' . $this->controlType)
            ->description('Schema description of control type ' . $this->controlType)
            ->required(...$requiredProperties)
            ->properties(...$properties);

        $this->registerRequirements($builder, $schema);

        return AllOf::create('ControlType' . ucfirst($this->controlType))
            ->schemas(Schema::ref(ControlSchema::FULL_REF), $schema);
    }
}
