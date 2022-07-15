<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoData;

final class UriData implements GeoData
{
    private string $uri;

    private string $format;

    public function __construct(string $uri, string $format)
    {
        $this->uri    = $uri;
        $this->format = $format;
    }

    /** @return array<string, string> */
    public function jsonSerialize(): array
    {
        return [
            'type'   => 'uri',
            'format' => $this->format,
            'uri'    => $this->uri,
        ];
    }
}
