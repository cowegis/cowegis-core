<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\GeoJson;

use GoldSpecDigital\ObjectOrientedOAS\Objects\ExternalDocs;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class PolygonSchema extends Schema
{
    public const SHORT_REF = 'GeoJSONPolygon';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(?string $objectId = null)
    {
        parent::__construct($objectId);

        $this->title        = 'GeoJSON Polygon';
        $this->type         = 'object';
        $this->required     = ['type', 'coordinates'];
        $this->properties   = [
            Schema::string('type')
                ->enum('Polygon'),
            Schema::array('coordinates')
                ->minItems(4)
                ->items(
                    Schema::array()
                        ->minItems(2)
                        ->items(Schema::create()->type('number'))
                ),
            BboxSchema::ref(),
        ];
        $this->externalDocs = ExternalDocs::create()->url('https://geojson.org/schema/Polygon.json');
    }
}
