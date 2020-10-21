<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Layer;

use Cowegis\Core\Schema\LayerSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;

final class TileLayerSchemaDescriber extends LayerSchemaDescriber
{
    /** @return Schema[] */
    protected function requiredProperties(SchemaBuilder $specificationBuilder): array
    {
        return [
            Schema::string('urlTemplate')
                ->title('URL template')
                ->example('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png')
                ->description('Used to load and display tile layers on the map'),
        ];
    }
}
