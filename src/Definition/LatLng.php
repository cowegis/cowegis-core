<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use Cowegis\Core\Exception\InvalidArgument;
use Cowegis\GeoJson\Position\Coordinates;
use JsonSerializable;

use function abs;
use function explode;
use function max;

/**
 * @psalm-type TSerializedLatLng = array{0: float, 1: float, 2?: float}
 */
final class LatLng implements JsonSerializable
{
    /**
     * Latitude value.
     *
     * @var float
     */
    private $latitude;

    /**
     * Longitude value.
     *
     * @var float
     */
    private $longitude;

    /**
     * Optional altitude value.
     *
     * @var float|null
     */
    private $altitude;

    /**
     * Construct.
     *
     * @param float      $latitude  The latitude.
     * @param float      $longitude The longitude.
     * @param float|null $altitude  Optional altitude.
     */
    public function __construct(float $latitude, float $longitude, ?float $altitude = null)
    {
        $this->latitude  = $latitude;
        $this->longitude = $longitude;

        if ($altitude === null) {
            return;
        }

        $this->altitude = $altitude;
    }

    /**
     * Create LatLng from array.
     *
     * @param array $native Native array.
     * @psalm-param array{0:float,1:float,2:float|null}
     *   |array{lat:float,lng:float,alt:float|null}
     *   |array{latitude:float,longitude:float,altitude:float|null} $native
     *
     * @return LatLng
     *
     * @throws \InvalidArgumentException If format is not supported.
     */
    public static function fromArray(array $native): self
    {
        $keys = [
            [0, 1, 2],
            ['lat', 'lng', 'alt'],
            ['latitude', 'longitude', 'altitude'],
        ];

        foreach ($keys as $key) {
            if (isset($native[$key[0]], $native[$key[1]])) {
                return new static(
                    (float) $native[$key[0]],
                    (float) $native[$key[1]],
                    isset($native[$key[2]]) ? ((float) $native[$key[2]]) : null
                );
            }
        }

        throw new InvalidArgument('LatLng format not supported');
    }

    /**
     * Create latlng from a string reprensentation.
     *
     * @param string $latLng Comma separated list of latlng values.
     *
     * @throws InvalidArgumentException If LatLng could not be created.
     */
    public static function fromString(string $latLng): LatLng
    {
        [$latitude, $longitude, $altitude] = explode(',', $latLng) + [null, null, null];

        Assertion::numeric($latitude);
        Assertion::numeric($longitude);
        Assertion::nullOrNumeric($altitude);

        $altitude = $altitude === null ? $altitude : (float) $altitude;

        return new static((float) $latitude, (float) $longitude, $altitude);
    }

    public function latitude(): float
    {
        return $this->latitude;
    }

    public function longitude(): float
    {
        return $this->longitude;
    }

    public function altitude(): ?float
    {
        return $this->altitude;
    }

    public function hasAltitude(): bool
    {
        return $this->altitude !== null;
    }

    /**
     * Compare 2 coordinates. It ignores the altitude.
     *
     * @param LatLng   $other          Another coordinate.
     * @param int|null $maxMargin      Margin of tolerance.
     * @param bool     $ignoreAltitude If true only longitude and latitude are compared.
     */
    public function equals(LatLng $other, ?int $maxMargin = null, bool $ignoreAltitude = true): bool
    {
        if ($maxMargin !== null) {
            $margin = max(
                abs($this->latitude() - $other->latitude()),
                abs($this->longitude() - $other->longitude())
            );

            $altitude = $this->altitude();
            if (! $ignoreAltitude && $altitude !== null) {
                $margin = max(
                    $margin,
                    abs($altitude - $other->longitude())
                );
            }

            return $margin <= $maxMargin;
        }

        if ($this->latitude() !== $other->latitude()) {
            return false;
        }

        if ($this->longitude() !== $other->longitude()) {
            return false;
        }

        return $ignoreAltitude || $this->altitude() === $other->altitude();
    }

    /**
     * Get latlng as geo json coordinate.
     */
    public function toGeoJson(): Coordinates
    {
        return new Coordinates($this->longitude(), $this->latitude(), $this->altitude());
    }

    /**
     * {@inheritdoc}
     *
     * @psalm-return TSerializedLatLng
     */
    public function jsonSerialize(): array
    {
        $raw = [
            $this->latitude(),
            $this->longitude(),
        ];

        if ($this->hasAltitude()) {
            /** @psalm-var float */
            $raw[] = $this->altitude();
        }

        return $raw;
    }

    /**
     * Create a string representation.
     *
     * @param bool $ignoreAltitude If true the altitude is not included.
     */
    public function toString(bool $ignoreAltitude = false): string
    {
        $buffer   = $this->latitude() . ',' . $this->longitude();
        $altitude = $this->altitude();

        if (! $ignoreAltitude && $altitude !== null) {
            $buffer .= ',' . $altitude;
        }

        return $buffer;
    }
}
