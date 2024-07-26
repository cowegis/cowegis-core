<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\GeoData;

use GoldSpecDigital\ObjectOrientedOAS\Objects\BaseObject;
use GoldSpecDigital\ObjectOrientedOAS\Objects\OneOf;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class GeoDataSchema extends OneOf
{
    public const SHORT_REF = 'GeoData';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(string|null $objectId = null)
    {
        parent::__construct($objectId ?? 'geodata');

        $this->schemas = [
            Schema::ref(UriDataSchema::FULL_REF),
            Schema::ref(ExternalDataSchema::FULL_REF),
            Schema::ref(InlineGeoJsonDataSchema::FULL_REF),
        ];
    }

    public static function ref(string $ref = '', string|null $objectId = null): BaseObject
    {
        return parent::ref($ref === '' ? self::FULL_REF : $ref, $objectId ?? 'geodata');
    }
}
