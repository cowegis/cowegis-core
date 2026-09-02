<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Control;

use Cowegis\Core\Schema\ControlSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Override;

final class ZoomControlSchemaDescriber extends ControlSchemaDescriber
{
    /**
     * @return Schema[]
     * @psalm-return list<Schema>
     */
    #[Override]
    protected function optionalProperties(SchemaBuilder $builder): array
    {
        return [
            Schema::boolean('replacesDefault')
                ->description('Whether this control replaces the Leaflet default zoom control')
                ->default(false),
        ];
    }
}
