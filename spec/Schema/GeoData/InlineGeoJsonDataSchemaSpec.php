<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema\GeoData;

use PhpSpec\ObjectBehavior;

final class InlineGeoJsonDataSchemaSpec extends ObjectBehavior
{
    public function it_describes_uri_data_schema(): void
    {
        $this->toArray()->shouldBe(
            [
                'title'       => 'Inline GeoJSON data',
                'description' => 'This data object refers to external data containing raw data in the defined format.',
                'type'        => 'object',
                'required'    => [
                    'type',
                    'format',
                    'data',
                ],
                'properties'  => [
                    'type'   => [
                        'enum' => ['inline'],
                        'type' => 'string',
                    ],
                    'format' => [
                        'enum' => ['geojson'],
                        'type' => 'string',
                    ],
                    'data'   => [
                        'oneOf' => [
                            ['$ref' => '#/components/schemas/GeoJSONFeature'],
                            ['$ref' => '#/components/schemas/GeoJSONFeatureCollection'],
                        ],
                    ],
                ],
            ],
        );
    }
}
