<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use Cowegis\Core\Schema\Error\ProblemResponses;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;
use Override;

final class MapSchemaDescriber implements SchemaDescriber
{
    /** @var LayerSchemaDescriber[] */
    private array $layerSchemas = [];

    /** @var ControlSchemaDescriber[] */
    private array $controlSchemas = [];

    /**
     * @param LayerSchemaDescriber[]   $layerSchemas
     * @param ControlSchemaDescriber[] $controlSchemas
     */
    public function __construct(iterable $layerSchemas, iterable $controlSchemas)
    {
        foreach ($layerSchemas as $layerSchema) {
            $this->layerSchemas[] = $layerSchema;
        }

        foreach ($controlSchemas as $controlSchema) {
            $this->controlSchemas[] = $controlSchema;
        }
    }

    #[Override]
    public function describe(SchemaBuilder $builder): void
    {
        $tag = Tag::create()
            ->name('Map')
            ->description('All map related endpoints');

        $mapRef   = $builder->components()->withSchema($this->mapSchema($builder));
        $assetRef = $builder->components()->withSchema(new AssetSchema(), AssetSchema::SHORT_REF);

        $envelope = $builder->components()->withSchema(
            Schema::object('MapResponse')
                ->description('Full map definition plus the assets required to render it')
                ->required('map', 'assets')
                ->properties(
                    $mapRef->objectId('map'),
                    Schema::array('assets')->items($assetRef),
                ),
        );

        $response = Response::ok('Full map definition with assets')
            ->content(MediaType::json()->schema($envelope));

        $mapDetails = Operation::get()
            ->description('This entrypoint provides all information to render a map with cowegis.')
            ->summary('Show full map details')
            ->parameters(
                Parameter::path()
                    ->name('mapId')
                    ->schema($builder->idSchemaRef())
                    ->required(),
            )
            ->tags($tag)
            ->responses($response, ProblemResponses::notFound());

        $path = (new PathItem())
            ->route('/map/{mapId}')
            ->operations($mapDetails);

        $builder->withPathItem($path);
    }

    /** @return Schema[] */
    private function buildLayerSchemas(SchemaBuilder $builder): array
    {
        $builder->components()->withSchema(LayerSchema::create('LayerType'), LayerSchema::SHORT_REF);

        $schemas = [];
        foreach ($this->layerSchemas as $describer) {
            $schemas[] = $builder->components()->withSchema($describer->describe($builder));
        }

        return $schemas;
    }

    /** @return Schema[] */
    private function buildControlSchemas(SchemaBuilder $builder): array
    {
        $builder->components()->withSchema(new ControlSchema(), ControlSchema::SHORT_REF);

        $schemas = [];
        foreach ($this->controlSchemas as $describer) {
            $schemas[] = $builder->components()->withSchema($describer->describe($builder));
        }

        return $schemas;
    }

    private function controlsItems(SchemaBuilder $builder): Schema|OneOf
    {
        $schemas = $this->buildControlSchemas($builder);

        if ($schemas === []) {
            return Schema::ref(ControlSchema::FULL_REF);
        }

        return OneOf::create()->schemas(...$schemas);
    }

    private function mapSchema(SchemaBuilder $builder): Schema
    {
        $mapLocateReference = $builder->components()->withSchema(
            OneOf::create()->schemas(Schema::boolean()->example('true'), new HashMap()),
            'MapLocate',
        );

        return Schema::object('MapSchema')
            ->properties(
                $builder->idSchemaRef('definitionId'),
                Schema::string('elementId')
                    ->example('map')
                    ->description('The HTML element id'),
                Schema::string('title')
                    ->example('Example map')
                    ->description('The title of the map'),
                Schema::object('options')
                    ->description('Key value map of map options'),
                Schema::array('layers')
                    ->description('Layers containing to the map')
                    ->items(OneOf::create()->schemas(...$this->buildLayerSchemas($builder))),
                Schema::array('controls')
                    ->description('Map controls')
                    ->items($this->controlsItems($builder)),
                Schema::array('panes')
                    ->description('Custom panes of the map')
                    ->items($builder->components()->withSchema($this->paneSchema($builder))),
                Schema::object('events')->additionalProperties(
                    Schema::object()
                        ->required('type', 'namespace', 'reference')
                        ->properties(
                            Schema::string('type')->enum('reference'),
                            Schema::array('namespace')->items(Schema::string())->nullable()->minItems(1),
                            Schema::string('reference'),
                        ),
                ),
                Schema::object('presets')
                    ->description('Reusable icon, popup, tooltip and style presets keyed by preset id')
                    ->required('icons', 'popups', 'styles', 'tooltips')
                    ->properties(
                        Schema::object('icons')->additionalProperties($this->iconPresetSchema($builder)),
                        Schema::object('popups')->additionalProperties($this->popupPresetSchema($builder)),
                        Schema::object('styles')->additionalProperties(HashMap::create()),
                        Schema::object('tooltips')->additionalProperties($this->tooltipPresetSchema($builder)),
                    ),
                Schema::object('view')
                    ->required('center', 'zoom', 'options')
                    ->properties(
                        Schema::array('center')
                            ->nullable()
                            ->minItems(2)
                            ->maxItems(3)
                            ->items(Schema::create()->type('number')),
                        Schema::number('zoom')
                            ->nullable()
                            ->minimum(0),
                        HashMap::create('options'),
                    ),
                $mapLocateReference->objectId('locate'),
                HashMap::create('bounds')
                    ->description('Describes how map bounds are managed')
                    ->properties(
                        Schema::boolean('dynamic')
                            ->default(false)
                            ->description('Indicates if bounds should be calculated dynamically'),
                        Schema::boolean('adjustAfterLoad')
                            ->default(false)
                            ->description('Indicates if bounds should be calculated dynamically after map is loaded'),
                        Schema::boolean('adjustAfterDeferred')
                            ->default(false)
                            ->description(
                                'Indicates if bounds should be calculated dynamically after all deferred map '
                                . 'data is loaded',
                            ),
                        Schema::array('paddingTopLeft')
                            ->description('Recognize top left padding when calculating bounds')
                            ->minItems(2)
                            ->maxItems(2)
                            ->items(Schema::create()->type('number')),
                        Schema::array('paddingBottomRight')
                            ->description('Recognize top left padding when calculating bounds')
                            ->minItems(2)
                            ->maxItems(2)
                            ->items(Schema::create()->type('number')),
                    ),
            );
    }

    private function paneSchema(SchemaBuilder $builder): Schema
    {
        return Schema::object('Pane')
            ->properties(
                $builder->idSchemaRef('paneId')
                    ->description('ID of the pane'),
                Schema::string('name')
                    ->description('Name used as Javascript identifier')
                    ->example('markers_pane'),
                Schema::integer('zIndex')->example(100),
                Schema::string('pointerEvents')
                    ->description('CSS setting for pointer events')
                    ->example('auto')
                    ->enum('auto', 'none'),
            )
            ->required('paneId', 'name', 'zIndex');
    }

    private function iconPresetSchema(SchemaBuilder $builder): Schema
    {
        return Schema::object('IconPreset')
            ->required('iconId', 'type')
            ->properties(
                $builder->idSchemaRef('iconId'),
                Schema::string('type')->example('svg')->description('Icon type name'),
                HashMap::create('options')->description('Key value map of icon options'),
            );
    }

    private function popupPresetSchema(SchemaBuilder $builder): Schema
    {
        return Schema::object('PopupPreset')
            ->required('content')
            ->properties(
                Schema::string('content')->description('Rendered popup HTML'),
                $builder->idSchemaRef('presetId')->nullable(),
                HashMap::create('options')->description('Key value map of popup options'),
                Schema::object('events')->description('Event reference map'),
            );
    }

    private function tooltipPresetSchema(SchemaBuilder $builder): Schema
    {
        return Schema::object('TooltipPreset')
            ->required('content')
            ->properties(
                Schema::string('content')->description('Rendered tooltip HTML'),
                Schema::array('coordinates')
                    ->nullable()
                    ->minItems(2)
                    ->maxItems(3)
                    ->items(Schema::number()),
                HashMap::create('options')->description('Key value map of tooltip options'),
                $builder->idSchemaRef('presetId')->nullable(),
                Schema::object('events')->description('Event reference map'),
            );
    }
}
