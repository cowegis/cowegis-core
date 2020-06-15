<?php

declare(strict_types=1);

namespace Cowegis\Core\Provider;

use Cowegis\Core\Definition\Asset\Assets;
use Cowegis\Core\Definition\Expression\Callbacks;
use Cowegis\Core\Definition\Map\MapId;
use Cowegis\Core\Filter\Filter;

abstract class ContextDecorator implements Context
{
    /** @var Context */
    private $inner;

    public function __construct(Context $context)
    {
        $this->inner = $context;
    }

    public function inner() : Context
    {
        return $this->inner;
    }

    public function mapId() : MapId
    {
        return $this->inner->mapId();
    }

    public function assets() : Assets
    {
        return $this->inner->assets();
    }

    public function callbacks() : Callbacks
    {
        return $this->inner->callbacks();
    }

    public function filter() : Filter
    {
        return $this->inner->filter();
    }

    public function locale() : string
    {
        return $this->inner->locale();
    }
}
