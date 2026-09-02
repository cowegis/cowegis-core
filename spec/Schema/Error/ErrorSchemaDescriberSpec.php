<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema\Error;

use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use function expect;

final class ErrorSchemaDescriberSpec extends ObjectBehavior
{
    public function it_registers_the_error_component(Info $info, Schema $idSchema, Schema $objectId): void
    {
        $idSchema->objectId(Argument::any())->willReturn($objectId->getWrappedObject());
        $idSchema->toArray()->willReturn(['type' => 'string']);
        $objectId->toArray()->willReturn(['type' => 'string']);

        $builder = SchemaBuilder::create($info->getWrappedObject(), $idSchema->getWrappedObject());
        $this->describe($builder);

        $schemas = $builder->components()->build()->toArray()['schemas'];

        expect($schemas)->shouldHaveKey('Error');
        expect($schemas['Error'])->shouldHaveKey('properties');
        expect($schemas['Error']['properties'])->shouldHaveKey('message');
        expect($schemas['Error']['properties'])->shouldHaveKey('code');
    }
}
