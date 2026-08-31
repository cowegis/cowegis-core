<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider;

use Cowegis\Core\Definition\Asset\Assets;
use Cowegis\Core\Definition\Expression\Callbacks;
use Cowegis\Core\Definition\Map\MapId;
use Cowegis\Core\Filter\Filter;
use Override;

abstract class ContextDecorator implements Context
{
    private Context $inner;

    public function __construct(Context $context)
    {
        $this->inner = $context;
    }

    public function inner(): Context
    {
        return $this->inner;
    }

    #[Override]
    public function mapId(): MapId
    {
        return $this->inner->mapId();
    }

    #[Override]
    public function assets(): Assets
    {
        return $this->inner->assets();
    }

    #[Override]
    public function callbacks(): Callbacks
    {
        return $this->inner->callbacks();
    }

    #[Override]
    public function filter(): Filter
    {
        return $this->inner->filter();
    }

    #[Override]
    public function locale(): string
    {
        return $this->inner->locale();
    }
}
