<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Layer;

use Cowegis\Core\Schema\GeoJson\FeatureCollectionSchema;
use Cowegis\Core\Schema\LayerSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class GeoJsonLayerDescriber extends LayerSchemaDescriber
{
    /** @return Schema[] */
    protected function requiredProperties(SchemaBuilder $builder): array
    {
        $reference = $builder->components()->withSchema(
            OneOf::create('data')
                ->schemas(
                    Schema::string()->format('url'),
                    Schema::ref(FeatureCollectionSchema::FULL_REF),
                ),
            'GeoJsonLayerData',
        );

        return [$reference->objectId('data')];
    }
}
