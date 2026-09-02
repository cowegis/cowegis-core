<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Error;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class ErrorSchema extends Schema
{
    public const SHORT_REF = 'Error';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(string|null $objectId = self::SHORT_REF)
    {
        parent::__construct($objectId);

        $this->type        = 'object';
        $this->title       = 'Error';
        $this->description = 'Error response payload';
        $this->required    = ['message'];
        $this->properties  = [
            Schema::string('message')
                ->description('Human readable error message')
                ->example('Map definition not found'),
            Schema::integer('code')
                ->description('Optional application error code')
                ->example(404),
        ];
    }
}
