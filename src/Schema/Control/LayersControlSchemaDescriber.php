<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Control;

use Cowegis\Core\Schema\ControlSchemaDescriber;
use Cowegis\Core\Schema\HashMap;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Override;

final class LayersControlSchemaDescriber extends ControlSchemaDescriber
{
    /**
     * @return Schema[]
     * @psalm-return list<Schema>
     */
    #[Override]
    protected function optionalProperties(SchemaBuilder $builder): array
    {
        return [
            HashMap::create('baseLayers')
                ->description('Selectable base layers keyed by layer id'),
            HashMap::create('overlays')
                ->description('Toggleable overlay layers keyed by layer id'),
        ];
    }
}
