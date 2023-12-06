<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Layer;

use Cowegis\Core\Schema\GeoJson\FeatureCollectionSchema;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;

final class MarkerLayerSchemaDescriber extends GeoJsonLayerDescriber
{
    protected function registerRequirements(SchemaBuilder $builder, Schema $schema): void
    {
        parent::registerRequirements($builder, $schema);

        $response = Response::ok('marker')
            ->content(MediaType::json()->schema(Schema::ref(FeatureCollectionSchema::FULL_REF)));

        // TODO error responses

        $layerDetails = Operation::get()
            ->description('')
            ->summary('Show full map details')
            ->parameters(
                Parameter::path()
                    ->name('definitionId')
                    ->schema($builder->idSchemaRef())
                    ->required(),
                Parameter::path()
                    ->name('layerId')
                    ->schema($builder->idSchemaRef())
                    ->required(),
            )
            ->tags(Tag::create()->name('Layer data'))
            ->responses($response);

        $builder->withPathItem(
            (new PathItem())
                ->route('/map/{definitionId}/markers/{layerId}')
                ->operations($layerDetails),
        );
    }
}
