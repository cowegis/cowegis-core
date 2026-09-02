<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema;

use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class ControlSchema extends Schema
{
    public const SHORT_REF = 'ControlType';

    public const FULL_REF = '#/components/schemas/' . self::SHORT_REF;

    public function __construct(string|null $objectId = null)
    {
        parent::__construct($objectId);

        $this->type        = 'object';
        $this->title       = 'Control type';
        $this->description = 'Required properties of a control type';
        $this->required    = ['controlId', 'name', 'type'];
        $this->properties  = [
            Schema::ref(IdSchema::FULL_REF, 'controlId'),
            Schema::string('name')
                ->title('Control name')
                ->example('zoom')
                ->description('Unique name of the control'),
            Schema::string('type')
                ->title('Control type')
                ->example('zoom')
                ->description('Control type name'),
            HashMap::create('options')
                ->title('Control options')
                ->description('Key value map of control options'),
        ];
    }
}
