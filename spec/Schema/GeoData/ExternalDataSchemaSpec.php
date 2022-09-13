<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema\GeoData;

use PhpSpec\ObjectBehavior;

final class ExternalDataSchemaSpec extends ObjectBehavior
{
    public function it_describes_uri_data_schema(): void
    {
        $this->toArray()->shouldBe(
            [
                'title'       => 'External data',
                'description' => 'This data object refers to external data containing raw data in the defined format.',
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
