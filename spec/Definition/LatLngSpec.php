<?php

declare(strict_types=1);

namespace spec\Cowegis\Core\Definition;

use Cowegis\Core\Definition\LatLng;
use JsonSerializable;
use PhpSpec\ObjectBehavior;

final class LatLngSpec extends ObjectBehavior
{
    private const LATITUDE  = 52.133331;
    private const LONGITUDE = 11.616667;
    private const ALTITUDE  = 102.0;

    public function let(): void
    {
        $this->beConstructedWith(self::LATITUDE, self::LONGITUDE, self::ALTITUDE);
    }

    public function it_is_initializable(): void
    {
        $this->shouldBeAnInstanceOf(LatLng::class);
    }

    public function it_has_latitude(): void
    {
        $this->latitude()->shouldBe(self::LATITUDE);
    }

    public function it_has_longitude(): void
    {
        $this->longitude()->shouldBe(self::LONGITUDE);
    }

    public function it_has_altitude(): void
    {
        $this->altitude()->shouldBe(self::ALTITUDE);
    }

    public function it_converts_to_geosjon(): void
    {
        $coordinates = $this->toGeoJson();

        $coordinates->latitude()->shouldBe(self::LATITUDE);
        $coordinates->longitude()->shouldBe(self::LONGITUDE);
        $coordinates->altitude()->shouldBe(self::ALTITUDE);
    }

    public function it_serializes_to_json(): void
    {
        $this->shouldBeAnInstanceOf(JsonSerializable::class);

        $this->jsonSerialize()->shouldReturn(
            [
                self::LATITUDE,
                self::LONGITUDE,
                self::ALTITUDE,
            ],
        );
    }
}
