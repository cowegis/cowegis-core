<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Layer;

use Cowegis\Core\Schema\LayerSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Override;

final class OverpassLayerSchemaDescriber extends LayerSchemaDescriber
{
    /**
     * @return Schema[]
     * @psalm-return list<Schema>
     */
    #[Override]
    protected function optionalProperties(SchemaBuilder $builder): array
    {
        return [
            Schema::string('query')
                ->description('Overpass QL query; the token BBOX is replaced with the current map bounds')
                ->example('(node(BBOX)[amenity];);out qt;'),
            Schema::string('endpoint')
                ->description('Base URL of the Overpass API instance')
                ->example('https://overpass-api.de/api/'),
            Schema::integer('minZoom')
                ->description('Minimum zoom level at which the query is executed')
                ->default(15),
            Schema::string('onEachFeature')
                ->description('Client callback reference invoked per feature')
                ->nullable(),
            Schema::string('pointToLayer')
                ->description('Client callback reference turning a point into a layer')
                ->nullable(),
        ];
    }
}
