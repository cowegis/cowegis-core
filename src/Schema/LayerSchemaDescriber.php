<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use GoldSpecDigital\ObjectOrientedOAS\Contracts\SchemaContract;
use GoldSpecDigital\ObjectOrientedOAS\Objects\AllOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

use function array_merge;
use function ucfirst;

abstract class LayerSchemaDescriber
{
    /** @var string */
    private $layerType;

    public function __construct(string $layerType)
    {
        $this->layerType = $layerType;
    }

    /**
     * @return Schema[]
     *
     * @psalam-return list<Schema>
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

    /**
     * @return Schema[]
     * @psalm-return list<Schema>
     */
    private function buildOptionalProperties(SchemaBuilder $builder): array
    {
        $properties = [];

        return array_merge($properties, $this->optionalProperties($builder));
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter) - Implementations might need the parameters
     */
    protected function registerRequirements(SchemaBuilder $builder, Schema $schema): void
    {
    }

    final public function describe(SchemaBuilder $builder): SchemaContract
    {
        $requiredProperties = $this->requiredProperties($builder);
        $optionalProperties = $this->buildOptionalProperties($builder);
        $properties         = array_merge($requiredProperties, $optionalProperties);

        $schema = Schema::object()
            ->title('Layer type ' . $this->layerType)
            ->description('Schema description of layer type ' . $this->layerType)
            ->required(...$requiredProperties)
            ->properties(...$properties);

        $this->registerRequirements($builder, $schema);

        return AllOf::create('LayerType' . ucfirst($this->layerType))
            ->schemas(
                Schema::ref(LayerSchema::FULL_REF),
                $schema
            );
    }
}
