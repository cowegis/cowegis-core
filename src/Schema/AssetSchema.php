<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use Cowegis\Core\Definition\Asset\Asset;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class AssetSchema extends Schema
{
    public const SHORT_REF = 'Asset';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(string|null $objectId = null)
    {
        parent::__construct($objectId);

        $this->type        = 'object';
        $this->title       = 'Asset';
        $this->description = 'A javascript or stylesheet asset the client must load for this response';
        $this->required    = ['type', 'url'];
        $this->properties  = [
            Schema::string('type')
                ->enum(Asset::TYPE_JAVASCRIPT, Asset::TYPE_STYLESHEET)
                ->example(Asset::TYPE_JAVASCRIPT),
            Schema::string('url')
                ->format('uri')
                ->example('/cowegis/js/callbacks/123.js'),
        ];
    }
}
