<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use Cowegis\Core\Schema\GeoData\ExternalDataSchema;
use Cowegis\Core\Schema\GeoData\GeoDataSchema;
use Cowegis\Core\Schema\GeoData\InlineGeoJsonDataSchema;
use Cowegis\Core\Schema\GeoData\UriDataSchema;

final class GeoDataSchemaDescriber implements SchemaDescriber
{
    public function describe(SchemaBuilder $builder): void
    {
        $components = $builder->components();
        $components->withSchema(new UriDataSchema(), UriDataSchema::SHORT_REF);
        $components->withSchema(new ExternalDataSchema(), ExternalDataSchema::SHORT_REF);
        $components->withSchema(new InlineGeoJsonDataSchema(), InlineGeoJsonDataSchema::SHORT_REF);
        $components->withSchema(new GeoDataSchema(), GeoDataSchema::SHORT_REF);
    }
}
