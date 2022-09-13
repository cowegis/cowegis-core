<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema;

use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use function expect;

final class GeoDataSchemaDescriberSpec extends ObjectBehavior
{
    public function it_is_a_schema_describer(Info $info, Schema $idSchema, Schema $objectId): void
    {
        $idSchema->objectId(Argument::any())->willReturn($objectId->getWrappedObject());
        $idSchema->toArray()->willReturn(['type' => 'string']);

        $objectId->toArray()->willReturn(['type' => 'string']);

        $builder = SchemaBuilder::create($info->getWrappedObject(), $idSchema->getWrappedObject());
        $this->describe($builder);

        $schema = $builder->components()->build()->toArray();

        expect($schema)->shouldHaveKey('schemas');
        expect($schema['schemas'])->shouldHaveKey('UriData');
        expect($schema['schemas'])->shouldHaveKey('ExternalData');
        expect($schema['schemas'])->shouldHaveKey('InlineGeoJsonData');
    }
}
