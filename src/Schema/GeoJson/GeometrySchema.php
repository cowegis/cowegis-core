<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\GeoJson;

use GoldSpecDigital\ObjectOrientedOAS\Objects\BaseObject;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class GeometrySchema extends OneOf
{
    public const SHORT_REF = 'GeoJSONGeometry';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(string|null $objectId = null)
    {
        parent::__construct($objectId);

        $this->schemas = [
            Schema::ref(PointSchema::FULL_REF),
            Schema::ref(LineStringSchema::FULL_REF),
            Schema::ref(PolygonSchema::FULL_REF),
            Schema::ref(MultiPolygonSchema::FULL_REF),
            Schema::ref(MultiLineStringSchema::FULL_REF),
            Schema::ref(MultiPointSchema::FULL_REF),
        ];
    }

    public static function ref(string $ref = '', string|null $objectId = null): BaseObject
    {
        return parent::ref($ref === '' ? self::FULL_REF : $ref, $objectId ?: 'bbox');
    }
}
