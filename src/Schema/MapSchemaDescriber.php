<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use Cowegis\Core\Definition\Asset\Asset;
use GoldSpecDigital\ObjectOrientedOAS\Objects\MediaType;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Operation;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Parameter;
use GoldSpecDigital\ObjectOrientedOAS\Objects\PathItem;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Response;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Tag;

final class MapSchemaDescriber implements SchemaDescriber
{
    /** @var LayerSchemaDescriber[] */
    private $layerSchemas;

    /** @var ControlSchemaDescriber[] */
    private $controlSchemas;

    /**
     * MapSchemaBuilder constructor.
     *
     * @param LayerSchemaDescriber[]   $layerSchemas
     * @param ControlSchemaDescriber[] $controlSchemas
     */
    public function __construct(iterable $layerSchemas, iterable $controlSchemas)
    {
        $this->layerSchemas   = $layerSchemas;
        $this->controlSchemas = $controlSchemas;
    }

    public function describe(SchemaBuilder $builder) : void
    {
        $tag = Tag::create()
            ->name('Map')
            ->description('All map related endpoints');

        $response = Response::ok('map')
            ->content(MediaType::json()->schema($builder->components()->withSchema($this->mapSchema($builder))));

        // TODO error responses

        $mapDetails = Operation::get()
            ->description('')
            ->summary('Show full map details')
            ->parameters(
                Parameter::path()
                    ->name('definitionId')
                    ->schema($builder->idSchemaRef())
                    ->required()
            )
            ->tags($tag)
            ->responses($response);

        $path = (new PathItem())
            ->route('/map/{definitionId}')
            ->operations($mapDetails);

        $builder->withPathItem($path);
    }

    private function buildLayerSchemas(SchemaBuilder $builder) : array
    {
        $builder->components()->withSchema(LayerSchema::create('LayerType'), LayerSchema::SHORT_REF);

        $schemas = [];
        foreach ($this->layerSchemas as $describer) {
            $schemas[] = $builder->components()->withSchema($describer->describe($builder));
        }

        return $schemas;
    }

    private function buildControlSchemas(SchemaBuilder $builder) : array
    {
        $schemas = [];
        foreach ($this->controlSchemas as $describer) {
            $schemas[] = $builder->components()->withSchema($describer->describe($builder));
        }

        return $schemas;
    }

    private function mapSchema(SchemaBuilder $builder) : Schema
    {
        $mapLocateReference = $builder->components()->withSchema(
            OneOf::create()->schemas(Schema::boolean()->example('true'), new HashMap()),
            'MapLocate'
        );

        return Schema::object('MapSchema')
            ->properties(
                $builder->idSchemaRef('definitionId'),
                Schema::string('title')->example('Example map'),
                Schema::object('options')->description('Key value map of map options'),
                Schema::array('layers')->items(OneOf::create()->schemas(... $this->buildLayerSchemas($builder))),
                // TODO: Fixme since implemented
                //  Schema::array('controls'), //->items(OneOf::create()->schemas(...$this->buildControlSchemas($builder))),
                Schema::array('panes')->items($builder->components()->withSchema($this->paneSchema())),
                Schema::object('events')->additionalProperties(
                    Schema::object()
                        ->required('type', 'namespace', 'reference')
                        ->properties(
                            Schema::string('type')->enum('reference'),
                            Schema::array('namespace')->items(Schema::string())->nullable()->minItems(1),
                            Schema::string('reference')
                        )
                ),
                Schema::array('assets')->items(
                    Schema::object()
                        ->required('type', 'url')
                        ->properties(
                            Schema::string('type')
                                ->enum(Asset::TYPE_JAVASCRIPT, Asset::TYPE_STYLESHEET)
                                ->example(Asset::TYPE_JAVASCRIPT),
                            Schema::string('url')
                                ->format('url')
                                ->example('/cowegis/js/callbacks/123.js')
                        )
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
                        HashMap::create('options')
                    ),
                $mapLocateReference->objectId('locate')
            );
    }

    /**
     * @return Schema
     */
    private function paneSchema() : Schema
    {
        return Schema::object('Pane')
            ->properties(
                Schema::string('paneId')->example('pane001'),
                Schema::integer('zIndex')->example(100)
            );
    }
}
