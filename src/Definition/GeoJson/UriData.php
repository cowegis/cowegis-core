<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoJson;

final class UriData implements GeoJsonData
{
    /** @var string */
    private $uri;

    public function __construct(string $uri)
    {
        $this->uri = $uri;
    }

    /** @return array<string, string> */
    public function jsonSerialize(): array
    {
        return [
            'type'   => 'uri',
            'format' => 'geojson',
            'uri'    => $this->uri,
        ];
    }
}
