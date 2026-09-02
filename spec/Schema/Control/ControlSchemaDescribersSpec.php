<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Schema\Control;

use Cowegis\Core\Schema\Control\AttributionControlSchemaDescriber;
use Cowegis\Core\Schema\Control\LayersControlSchemaDescriber;
use Cowegis\Core\Schema\Control\ZoomControlSchemaDescriber;
use Cowegis\Core\Schema\SchemaBuilder;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Info;
use GoldSpecDigital\ObjectOrientedOAS\Objects\Schema;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use function expect;

final class ControlSchemaDescribersSpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beAnInstanceOf(ZoomControlSchemaDescriber::class);
        $this->beConstructedWith('zoom');
    }

    public function it_names_the_zoom_variant(Info $info, Schema $idSchema, Schema $objectId): void
    {
        $builder = self::builder($info, $idSchema, $objectId);

        $array = $this->describe($builder)->getWrappedObject()->toArray();

        expect($array['allOf'][1]['properties'])->shouldHaveKey('replacesDefault');
    }

    public function it_describes_layers_control_collections(Info $info, Schema $idSchema, Schema $objectId): void
    {
        $describer = new LayersControlSchemaDescriber('layers');
        $builder   = self::builder($info, $idSchema, $objectId);

        $array = $describer->describe($builder)->toArray();

        expect($array['allOf'][1]['properties'])->shouldHaveKey('baseLayers');
        expect($array['allOf'][1]['properties'])->shouldHaveKey('overlays');
    }

    public function it_describes_attribution_control_lists(Info $info, Schema $idSchema, Schema $objectId): void
    {
        $describer = new AttributionControlSchemaDescriber('attribution');
        $builder   = self::builder($info, $idSchema, $objectId);

        $array = $describer->describe($builder)->toArray();

        expect($array['allOf'][1]['properties'])->shouldHaveKey('attributions');
    }

    private static function builder(Info $info, Schema $idSchema, Schema $objectId): SchemaBuilder
    {
        $idSchema->objectId(Argument::any())->willReturn($objectId->getWrappedObject());
        $idSchema->toArray()->willReturn(['type' => 'string']);
        $objectId->toArray()->willReturn(['type' => 'string']);

        return SchemaBuilder::create($info->getWrappedObject(), $idSchema->getWrappedObject());
    }
}
