<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\GeoJson;

use GoldSpecDigital\ObjectOrientedOAS\Objects\BaseObject;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class BboxSchema extends Schema
{
    public const SHORT_REF = 'GeoJSONBbox';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(string $objectId = null)
    {
        parent::__construct($objectId ?: 'bbox');

        $this->title    = 'GeoJSON Bbox';
        $this->minItems = 4;
        $this->type     = 'array';
        $this->items    = Schema::create()->type('number');
        $this->example  = [125.6, 10.1, 254.2, 12.2];
    }

    public static function ref(string $ref = '', string $objectId = null) : BaseObject
    {
        return parent::ref($ref === '' ? self::FULL_REF : $ref, $objectId ?: 'bbox');
    }
}
