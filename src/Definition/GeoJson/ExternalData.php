<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoJson;

final class ExternalData implements GeoJsonData
{
    /** @var string */
    private $uri;

    /** @var string */
    private $format;

    public function __construct(string $uri, string $format)
    {
        $this->uri    = $uri;
        $this->format = $format;
    }

    public function uri() : string
    {
        return $this->uri;
    }

    public function format() : string
    {
        return $this->format;
    }

    public function jsonSerialize() : array
    {
        return [
            'type'   => 'external',
            'format' => $this->format,
            'uri'    => $this->uri,
        ];
    }
}
