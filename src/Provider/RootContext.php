<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider;

use Cowegis\Core\Definition\Asset\Assets;
use Cowegis\Core\Definition\Expression\Callbacks;
use Cowegis\Core\Definition\Map\MapId;
use Cowegis\Core\Filter\Filter;

abstract class RootContext implements Context
{
    public function __construct(
        private Callbacks $callbacks,
        private Assets $assets,
        private Filter $filter,
        private MapId $mapId,
        private string $locale,
    ) {
    }

    public function mapId(): MapId
    {
        return $this->mapId;
    }

    public function assets(): Assets
    {
        return $this->assets;
    }

    public function callbacks(): Callbacks
    {
        return $this->callbacks;
    }

    public function filter(): Filter
    {
        return $this->filter;
    }

    public function locale(): string
    {
        return $this->locale;
    }
}
