<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Layer;

use Cowegis\Core\Schema\LayerSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

class LayerGroupLayerSchemaDescriber extends LayerSchemaDescriber
{
    /** @return Schema[] */
    protected function requiredProperties(SchemaBuilder $specificationBuilder): array
    {
        return [
            Schema::array('layers')
                ->title('Layers')
                ->example([1, 2])
                ->description('List of integrated layers')
                ->items($specificationBuilder->idSchemaRef()),
        ];
    }
}
