<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoJson;

final class ExternalData implements GeoJsonData
{
    private string $uri;

    private string $format;

    public function __construct(string $uri, string $format)
    {
        $this->uri    = $uri;
        $this->format = $format;
    }

    public function uri(): string
    {
        return $this->uri;
    }

    public function format(): string
    {
        return $this->format;
    }

    /** @return array<string, string> */
    public function jsonSerialize(): array
    {
        return [
            'type'   => 'external',
            'format' => $this->format,
            'uri'    => $this->uri,
        ];
    }
}
