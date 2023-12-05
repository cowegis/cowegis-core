<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Layer;

use Cowegis\Core\Schema\GeoData\GeoDataSchema;
use Cowegis\Core\Schema\LayerSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class DataLayerSchemaDescriber extends LayerSchemaDescriber
{
    /** @return Schema[] */
    protected function requiredProperties(SchemaBuilder $builder): array
    {
        $reference = $builder->components()->withSchema(
            OneOf::create('data')
                ->schemas(
                    Schema::ref(GeoDataSchema::FULL_REF),
                    Schema::create()->type('null')
                ),
            'DataLayerData'
        );

        return [$reference->objectId('data')];
    }
}
