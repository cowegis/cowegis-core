<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Definition\Control;

use Cowegis\Core\Definition\Control\ControlId;
use Cowegis\Core\Definition\Control\GeocoderControl;
use Cowegis\Core\Definition\DefinitionId;
use PhpSpec\ObjectBehavior;

final class GeocoderControlSpec extends ObjectBehavior
{
    public function let(DefinitionId $definitionId): void
    {
        $this->beConstructedWith(new ControlId($definitionId->getWrappedObject()), 'geocoder');
    }

    public function it_is_initializable(): void
    {
        $this->shouldBeAnInstanceOf(GeocoderControl::class);
    }

    public function it_has_custom_geocoder_support(): void
    {
        $this->useGeocoder('bing', ['apiKey' => '12345']);
        $this->geocoder()->shouldReturn(['type' => 'bing', 'options' => ['apiKey' => '12345']]);

        $this->useGeocoder('google', ['apiKey' => '0000']);
        $this->geocoder()->shouldReturn(['type' => 'google', 'options' => ['apiKey' => '0000']]);
    }

    public function it_supports_options(): void
    {
        $this->options()->set('showUniqueResult', false);
        $this->options()->set('showResultIcons', true);
        $this->options()->set('collapsed', false);
        $this->options()->set('expand', 'click');
        $this->options()->set('position', 'bottomleft');
        $this->options()->set('query', 'Earth');
        $this->options()->set('queryMinLength', 10);
        $this->options()->set('suggestMinLength', 30);
        $this->options()->set('suggestTimeout', 2500);
        $this->options()->set('defaultMarkGeocode', false);

        $this->options()->toArray()->shouldReturn(
            [
                'showUniqueResult'   => false,
                'showResultIcons'    => true,
                'collapsed'          => false,
                'expand'             => 'click',
                'position'           => 'bottomleft',
                'query'              => 'Earth',
                'queryMinLength'     => 10,
                'suggestMinLength'   => 30,
                'suggestTimeout'     => 2500,
                'defaultMarkGeocode' => false,
            ]
        );
    }

    public function it_ignores_default_options(): void
    {
        $this->options()->set('showUniqueResult', true);
        $this->options()->set('showResultIcons', false);
        $this->options()->set('collapsed', true);
        $this->options()->set('expand', 'touch');
        $this->options()->set('position', 'topright');
        $this->options()->set('query', '');
        $this->options()->set('queryMinLength', 1);
        $this->options()->set('suggestMinLength', 3);
        $this->options()->set('suggestTimeout', 250);
        $this->options()->set('defaultMarkGeocode', true);

        $this->options()->toArray()->shouldReturn([]);
    }
}
