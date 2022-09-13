<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema\GeoData;

use PhpSpec\ObjectBehavior;

final class UriDataSchemaSpec extends ObjectBehavior
{
    public function it_describes_uri_data_schema(): void
    {
        $this->toArray()->shouldBe(
            [
                'title'       => 'Uri data',
                'description' => 'The Uri data refers to a data source, where the target also provide a data'
                    . ' layer object.',
                'type'        => 'object',
                'required'    => [
                    'type',
                    'uri',
                    'format',
                ],
                'properties'  => [
                    'type'   => [
                        'enum' => ['uri'],
                        'type' => 'string',
                    ],
                    'uri'    => [
                        'format' => 'uri',
                        'type'   => 'string',
                    ],
                    'format' => [
                        'description' => 'The data format of the data from the external source',
                        'type'        => 'string',
                        'example'     => 'geojson',
                    ],
                ],
                'example'     => [
                    'type'   => 'uri',
                    'uri'    => 'https://example.org/geodata.json',
                    'format' => 'geojson',
                ],
            ]
        );
    }
}
