<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class LayerSchema extends Schema
{
    public const SHORT_REF = 'LayerType';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(?string $objectId = null)
    {
        parent::__construct($objectId);

        $this->type        = 'object';
        $this->title       = 'Layer type';
        $this->description = 'Required properties of a layer type';
        $this->required    = ['name', 'type'];
        $this->properties  = [
            Schema::ref(IdSchema::FULL_REF, 'layerId'),
            Schema::string('name')
                ->title('Layer name')
                ->example('markers')
                ->description('Unique name of the layer'),
            Schema::string('title')
                ->title('Layer title')
                ->example('Markers')
                ->description('Layer title for visual representation of the layer'),
            Schema::string('type')
                ->title('Layer type')
                ->example('marker')
                ->description('Layer type name'),
            Schema::boolean('initialVisible')
                ->title('Initial visible')
                ->default(true)
                ->example(true)
                ->description('If true layer should be visible on every map'),
            HashMap::create('options')
                ->title('Layer type options')
                ->description('Key value map of layer type options'),
        ];
    }
}
