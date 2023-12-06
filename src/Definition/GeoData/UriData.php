<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\GeoData;

/**
 * The Uri data refers to a data source provided from an uri, where the target will also provide a data layer object.
 */
final class UriData implements GeoData
{
    public function __construct(private string $uri, private string $format)
    {
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
