<?php

declare(strict_types=1);

namespace Cowegis\Core\Schema\Control;

use Cowegis\Core\Schema\ControlSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use Override;

final class AttributionControlSchemaDescriber extends ControlSchemaDescriber
{
    /**
     * @return Schema[]
     * @psalm-return list<Schema>
     */
    #[Override]
    protected function optionalProperties(SchemaBuilder $builder): array
    {
        return [
            Schema::array('attributions')
                ->description('Static attribution strings rendered by the control')
                ->items(Schema::string()),
            Schema::boolean('replacesDefault')
                ->description('Whether this control replaces the Leaflet default attribution control')
                ->default(false),
        ];
    }
}
