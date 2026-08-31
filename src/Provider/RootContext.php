<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider;

use Cowegis\Core\Definition\Asset\Assets;
use Cowegis\Core\Definition\Expression\Callbacks;
use Cowegis\Core\Definition\Map\MapId;
use Cowegis\Core\Filter\Filter;
use Override;

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

    #[Override]
    public function mapId(): MapId
    {
        return $this->mapId;
    }

    #[Override]
    public function assets(): Assets
    {
        return $this->assets;
    }

    #[Override]
    public function callbacks(): Callbacks
    {
        return $this->callbacks;
    }

    #[Override]
    public function filter(): Filter
    {
        return $this->filter;
    }

    #[Override]
    public function locale(): string
    {
        return $this->locale;
    }
}
