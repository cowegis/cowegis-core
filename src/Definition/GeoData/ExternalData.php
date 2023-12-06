<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoData;

/**
 * This data object refers to external data where the external data contains only raw data in the defined format.
 */
final class ExternalData implements GeoData
{
    public function __construct(private readonly string $uri, private readonly string $format)
    {
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
