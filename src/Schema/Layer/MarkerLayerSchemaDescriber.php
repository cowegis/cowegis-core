<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Layer;

use Cowegis\Core\Schema\AssetSchema;
use Cowegis\Core\Schema\Error\ProblemResponses;
use Cowegis\Core\Schema\GeoJson\FeatureCollectionSchema;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;
use Override;

final class MarkerLayerSchemaDescriber extends GeoJsonLayerDescriber
{
    #[Override]
    protected function registerRequirements(SchemaBuilder $builder, Schema $schema): void
    {
        parent::registerRequirements($builder, $schema);

        $envelope = $builder->components()->withSchema(
            Schema::object('MarkerDataResponse')
                ->description('Marker feature collection plus required assets')
                ->required('data', 'assets')
                ->properties(
                    Schema::ref(FeatureCollectionSchema::FULL_REF, 'data'),
                    Schema::array('assets')->items(Schema::ref(AssetSchema::FULL_REF)),
                ),
        );

        $response = Response::ok('Marker layer data')
            ->content(MediaType::json()->schema($envelope));

        $layerDetails = Operation::get()
            ->description('Deferred marker features for a single layer of a map')
            ->summary('Show marker layer data')
            ->parameters(
                Parameter::path()
                    ->name('mapId')
                    ->schema($builder->idSchemaRef())
                    ->required(),
                Parameter::path()
                    ->name('layerId')
                    ->schema($builder->idSchemaRef())
                    ->required(),
            )
            ->tags(Tag::create()->name('Layer data'))
            ->responses($response, ProblemResponses::notFound());

        $builder->withPathItem(
            (new PathItem())
                ->route('/map/{mapId}/markers/{layerId}')
                ->operations($layerDetails),
        );
    }
}
