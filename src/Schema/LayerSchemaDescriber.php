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
     * @psalam-return list<Schema>
     *
     * @return Schema[]
     */
    protected function requiredProperties(SchemaBuilder $specificationBuilder) : array
    {
        return [];
    }

    /**
     * @psalam-return list<Schema>
     *
     * @return Schema[]
     */
    protected function optionalProperties(SchemaBuilder $specificationBuilder) : array
    {
        return [];
    }

    private function buildOptionalProperties(SchemaBuilder $builder) : array
    {
        $properties = [];

        return array_merge($properties, $this->optionalProperties($builder));
    }

    protected function registerRequirements(SchemaBuilder $specificationBuilder, Schema $schema) : void
    {
    }

    final public function describe(SchemaBuilder $specificationBuilder) : SchemaContract
    {
        $requiredProperties = $this->requiredProperties($specificationBuilder);
        $optionalProperties = $this->buildOptionalProperties($specificationBuilder);
        $properties         = array_merge($requiredProperties, $optionalProperties);

        $schema = Schema::object()
            ->title('Layer type ' . $this->layerType)
            ->description('Schema description of layer type ' . $this->layerType)
            ->required(... $requiredProperties)
            ->properties(...$properties);

        $this->registerRequirements($specificationBuilder, $schema);

        return AllOf::create('LayerType' . ucfirst($this->layerType))
            ->schemas(
                Schema::ref(LayerSchema::FULL_REF),
                $schema
            );
    }
}
