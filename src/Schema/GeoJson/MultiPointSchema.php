<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\GeoJson;

use GoldSpecDigital\ObjectOrientedOAS\Objects\ExternalDocs;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class MultiPointSchema extends Schema
{
    public const SHORT_REF = 'GeoJSONMultiPoint';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(?string $objectId = null)
    {
        parent::__construct($objectId);

        $this->title        = 'GeoJSON MultiPoint';
        $this->type         = 'object';
        $this->required     = ['type', 'coordinates'];
        $this->properties   = [
            Schema::string('type')
                ->enum('MultiPoint'),
            Schema::array('coordinates')
                ->minItems(2)
                ->items(
                    Schema::array()
                        ->minItems(2)
                        ->items(Schema::create()->type('number'))
                ),
            BboxSchema::ref(),
        ];
        $this->externalDocs = ExternalDocs::create()->url('https://geojson.org/schema/MultiPoint.json');
    }
}
