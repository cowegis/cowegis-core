<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\GeoJson;

use GoldSpecDigital\ObjectOrientedOAS\Objects\ExternalDocs;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class FeatureCollectionSchema extends Schema
{
    public const SHORT_REF = 'GeoJSONFeatureCollection';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(string|null $objectId = null)
    {
        parent::__construct($objectId);

        $this->title        = 'GeoJSON FeatureCollection';
        $this->type         = 'object';
        $this->required     = ['type', 'features'];
        $this->properties   = [
            Schema::string('type')
                ->enum('FeatureCollection'),
            Schema::array('features')
                ->items(Schema::ref(FeatureSchema::FULL_REF)),
            BboxSchema::ref(),
        ];
        $this->externalDocs = ExternalDocs::create()->url('https://geojson.org/schema/FeatureCollection.json');
    }
}
