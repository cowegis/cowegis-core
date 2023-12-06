<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\GeoData;

use GoldSpecDigital\ObjectOrientedOAS\Objects\BaseObject;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class ExternalDataSchema extends Schema
{
    public const SHORT_REF = 'ExternalData';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(string|null $objectId = null)
    {
        parent::__construct($objectId ?: 'externaldata');

        $this->title       = 'External data';
        $this->description = 'This data object refers to external data containing raw data in the defined format.';
        $this->type        = 'object';
        $this->properties  = [
            Schema::string('type')
                ->enum('uri'),
            Schema::string('uri')
                ->format('uri'),
            Schema::string('format')
                ->description('The data format of the data from the external source')
                ->example('geojson'),
        ];
        $this->example     = [
            'type'   => 'uri',
            'uri'    => 'https://example.org/geodata.json',
            'format' => 'geojson',
        ];
        $this->required    = ['type', 'uri', 'format'];
    }

    public static function ref(string $ref = '', string|null $objectId = null): BaseObject
    {
        return parent::ref($ref === '' ? self::FULL_REF : $ref, $objectId ?: 'uridata');
    }
}
