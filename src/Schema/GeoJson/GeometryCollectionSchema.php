<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\GeoJson;

use GoldSpecDigital\ObjectOrientedOAS\Objects\ExternalDocs;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class GeometryCollectionSchema extends Schema
{
    public const SHORT_REF = 'GeoJSONGeometryCollection';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(string $objectId = null)
    {
        parent::__construct($objectId);

        $this->title        = 'GeoJSON GeometryCollection';
        $this->type         = 'object';
        $this->required     = ['type', 'geometries'];
        $this->properties   = [
            Schema::string('type')
                ->enum('GeometryCollection'),
            Schema::array('geometries')
                ->items(Schema::ref(GeometrySchema::FULL_REF)),
            BboxSchema::ref(),
        ];
        $this->externalDocs = ExternalDocs::create()->url('https://geojson.org/schema/GeometryCollection.json');
    }
}
