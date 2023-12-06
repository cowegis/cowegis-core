<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\GeoJson;

use GoldSpecDigital\ObjectOrientedOAS\Objects\ExternalDocs;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class PointSchema extends Schema
{
    public const SHORT_REF = 'GeoJSONPoint';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(string|null $objectId = null)
    {
        parent::__construct($objectId);

        $this->title        = 'GeoJSON Point';
        $this->type         = 'object';
        $this->required     = ['type', 'coordinates'];
        $this->properties   = [
            Schema::string('type')
                ->enum('Point'),
            Schema::array('coordinates')
                ->minItems(2)
                ->items(Schema::create()->type('number')),
            BboxSchema::ref(),
        ];
        $this->externalDocs = ExternalDocs::create()->url('https://geojson.org/schema/Point.json');
        $this->example      = [
            'type'        => 'Point',
            'coordinates' => [125.6, 10.1],
            'bbox'        => [125.6, 10.1, 254.2, 12.2],
        ];
    }
}
