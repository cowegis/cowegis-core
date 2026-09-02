<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema;

use Cowegis\Core\Schema\Control\ZoomControlSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use function expect;

final class MapSchemaDescriberSpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beConstructedWith([], [new ZoomControlSchemaDescriber('zoom')]);
    }

    public function it_registers_the_control_base_and_a_non_empty_controls_oneof(
        Info $info,
        Schema $idSchema,
        Schema $objectId,
    ): void {
        $builder = self::builder($info, $idSchema, $objectId);
        $this->describe($builder);

        $doc = $builder->build()->toArray();

        expect($doc['components']['schemas'])->shouldHaveKey('ControlType');

        $controls = $doc['components']['schemas']['MapSchema']['properties']['controls'];
        expect($controls['type'])->toBe('array');
        expect($controls['items'])->shouldHaveKey('oneOf');
        expect($controls['items']['oneOf'])->shouldHaveCount(1);
    }

    public function it_describes_presets_and_drops_assets(Info $info, Schema $idSchema, Schema $objectId): void
    {
        $builder = self::builder($info, $idSchema, $objectId);
        $this->describe($builder);

        $props = $builder->build()->toArray()['components']['schemas']['MapSchema']['properties'];

        expect($props)->shouldHaveKey('presets');
        expect($props['presets']['properties'])->shouldHaveKey('icons');
        expect($props['presets']['properties'])->shouldHaveKey('popups');
        expect($props['presets']['properties'])->shouldHaveKey('styles');
        expect($props['presets']['properties'])->shouldHaveKey('tooltips');
        expect($props)->shouldNotHaveKey('assets');
    }

    public function it_wraps_the_map_response_in_an_envelope_with_assets(
        Info $info,
        Schema $idSchema,
        Schema $objectId,
    ): void {
        $builder = self::builder($info, $idSchema, $objectId);
        $this->describe($builder);

        $doc = $builder->build()->toArray();

        expect($doc['components']['schemas'])->shouldHaveKey('MapResponse');
        expect($doc['components']['schemas']['MapResponse']['properties'])->shouldHaveKey('map');
        expect($doc['components']['schemas']['MapResponse']['properties'])->shouldHaveKey('assets');
        expect($doc['components']['schemas'])->shouldHaveKey('Asset');

        $responses = $doc['paths']['/map/{mapId}']['get']['responses'];
        expect($responses)->shouldHaveKey(200);
        expect($responses)->shouldHaveKey(404);
    }

    private static function builder(Info $info, Schema $idSchema, Schema $objectId): SchemaBuilder
    {
        $info->toArray()->willReturn(['title' => 'Test API', 'version' => '1.0.0']);
        $idSchema->objectId(Argument::any())->willReturn($objectId->getWrappedObject());
        $idSchema->toArray()->willReturn(['type' => 'string']);
        $objectId->toArray()->willReturn(['type' => 'string']);

        return SchemaBuilder::create($info->getWrappedObject(), $idSchema->getWrappedObject());
    }
}
