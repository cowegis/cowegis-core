<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Serializer\Control;

use Cowegis\Core\Definition\Control\ControlId;
use Cowegis\Core\Definition\Control\GeocoderControl;
use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Serializer\Control\GeocoderControlSerializer;
use Cowegis\Core\Serializer\Serializer;
use PhpSpec\ObjectBehavior;

final class GeocoderControlSerializerSpec extends ObjectBehavior
{
    public function let(Serializer $serializer): void
    {
        $this->beConstructedWith($serializer);
    }

    public function it_is_initializable(): void
    {
        $this->shouldBeAnInstanceOf(GeocoderControlSerializer::class);
    }

    public function it_serializes_control(DefinitionId $definitionId, Serializer $serializer): void
    {
        $control = new GeocoderControl(new ControlId($definitionId->getWrappedObject()), 'example');
        $control->options()->set('collapsed', false);
        $control->useGeocoder('bing', []);

        $definitionId->value()->willReturn('example_1');

        $serializer->serialize($control->options())
            ->shouldBeCalledOnce()
            ->willReturn(['collapsed' => false]);

        $this->serialize($control)->shouldReturn(
            [
                'controlId' => 'example_1',
                'name'      => 'example',
                'type'      => 'geocoder',
                'options'   => ['collapsed' => false],
                'geocoder'  => [
                    'type'    => 'bing',
                    'options' => [],
                ],
            ]
        );
    }
}
