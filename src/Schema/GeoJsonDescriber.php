<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use Cowegis\Core\Schema\GeoJson\BboxSchema;
use Cowegis\Core\Schema\GeoJson\FeatureCollectionSchema;
use Cowegis\Core\Schema\GeoJson\FeatureSchema;
use Cowegis\Core\Schema\GeoJson\GeometryCollectionSchema;
use Cowegis\Core\Schema\GeoJson\GeometrySchema;
use Cowegis\Core\Schema\GeoJson\LineStringSchema;
use Cowegis\Core\Schema\GeoJson\MultiLineStringSchema;
use Cowegis\Core\Schema\GeoJson\MultiPointSchema;
use Cowegis\Core\Schema\GeoJson\MultiPolygonSchema;
use Cowegis\Core\Schema\GeoJson\PointSchema;
use Cowegis\Core\Schema\GeoJson\PolygonSchema;

final class GeoJsonDescriber implements SchemaDescriber
{
    public function describe(SchemaBuilder $builder): void
    {
        $components = $builder->components();
        $components->withSchema(new BboxSchema(), BboxSchema::SHORT_REF);
        $components->withSchema(new FeatureCollectionSchema(), FeatureCollectionSchema::SHORT_REF);
        $components->withSchema(new FeatureSchema(), FeatureSchema::SHORT_REF);
        $components->withSchema(new GeometryCollectionSchema(), GeometryCollectionSchema::SHORT_REF);
        $components->withSchema(new GeometrySchema(), GeometrySchema::SHORT_REF);
        $components->withSchema(new LineStringSchema(), LineStringSchema::SHORT_REF);
        $components->withSchema(new MultiLineStringSchema(), MultiLineStringSchema::SHORT_REF);
        $components->withSchema(new MultiPointSchema(), MultiPointSchema::SHORT_REF);
        $components->withSchema(new MultiPolygonSchema(), MultiPolygonSchema::SHORT_REF);
        $components->withSchema(new PointSchema(), PointSchema::SHORT_REF);
        $components->withSchema(new PolygonSchema(), PolygonSchema::SHORT_REF);
    }
}
