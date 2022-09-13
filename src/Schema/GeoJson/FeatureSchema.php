<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\GeoJson;

use Cowegis\Core\Schema\HashMap;
use GoldSpecDigital\ObjectOrientedOAS\Objects\ExternalDocs;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class FeatureSchema extends Schema
{
    public const SHORT_REF = 'GeoJSONFeature';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(?string $objectId = null)
    {
        parent::__construct($objectId);

        $this->title    = 'GeoJSON Feature';
        $this->type     = 'object';
        $this->required = ['type', 'properties', 'geometry'];

        /** @psalm-suppress InvalidPropertyAssignmentValue */
        $this->properties   = [
            Schema::string('type')
                ->enum('Feature'),
            OneOf::create('id')
                ->schemas(
                    Schema::string(),
                    Schema::integer()
                ),
            HashMap::create('properties'),
            OneOf::create('geometry')
                ->schemas(
                    Schema::ref('#/components/schemas/NullValue'),
                    Schema::ref(GeometrySchema::FULL_REF)
                ),
            BboxSchema::ref(),
        ];
        $this->externalDocs = ExternalDocs::create()->url('https://geojson.org/schema/Feature.json');
    }
}
