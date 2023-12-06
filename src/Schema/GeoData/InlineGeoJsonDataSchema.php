<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\GeoData;

use Cowegis\Core\Schema\GeoJson\FeatureCollectionSchema;
use Cowegis\Core\Schema\GeoJson\FeatureSchema;
use GoldSpecDigital\ObjectOrientedOAS\Objects\BaseObject;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class InlineGeoJsonDataSchema extends Schema
{
    public const SHORT_REF = 'InlineGeoJsonData';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(string|null $objectId = null)
    {
        parent::__construct($objectId ?: 'inlinegeojsondata');

        $this->title       = 'Inline GeoJSON data';
        $this->description = 'This data object refers to external data containing raw data in the defined format.';
        $this->type        = 'object';

        /** @psalm-suppress InvalidPropertyAssignmentValue */
        $this->properties = [
            Schema::string('type')
                ->enum('inline'),
            Schema::string('format')
                ->enum('geojson'),
            OneOf::create('data')->schemas(
                Schema::ref(FeatureSchema::FULL_REF),
                Schema::ref(FeatureCollectionSchema::FULL_REF),
            ),
        ];
        $this->required   = ['type', 'format', 'data'];
    }

    public static function ref(string $ref = '', string|null $objectId = null): BaseObject
    {
        return parent::ref($ref === '' ? self::FULL_REF : $ref, $objectId ?: 'uridata');
    }
}
