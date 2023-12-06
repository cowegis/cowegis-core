<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Assert\Assertion;
use Assert\InvalidArgumentException;
use Cowegis\Core\Exception\InvalidArgument;
use Cowegis\GeoJson\Position\Coordinates;
use JsonSerializable;

use function abs;
use function array_pad;
use function explode;
use function max;

/**
 * @psalm-type TSerializedLatLng = array{0: float, 1: float, 2?: float}
 * @psalm-type TShortLatLng = array{lat:float,lng:float,alt:float|null}
 * @psalm-type TLongLatLng = array{latitude:float,longitude:float,altitude:float|null}
 * @psalm-type TRawLatLng = TSerializedLatLng|TShortLatLng|TLongLatLng
 */
final class LatLng implements JsonSerializable
{
    /**
     * Construct.
     *
     * @param float      $latitude  The latitude.
     * @param float      $longitude The longitude.
     * @param float|null $altitude  Optional altitude.
     */
    public function __construct(
        private readonly float $latitude,
        private readonly float $longitude,
        private readonly float|null $altitude = null,
    ) {
    }

    /**
     * Create LatLng from array.
     *
     * @param TRawLatLng $native
     *
     * @throws InvalidArgument If format is not supported.
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
                /** @psalm-suppress PossiblyUndefinedArrayOffset */
                return new self(
                    $native[$key[0]],
                    $native[$key[1]],
                    $native[$key[2]] ?? null,
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
     * @throws InvalidArgumentException When LatLng could not be created.
     */
    public static function fromString(string $latLng): LatLng
    {
        [$latitude, $longitude, $altitude] = array_pad(explode(',', $latLng), 3, null);

        Assertion::numeric($latitude);
        Assertion::numeric($longitude);
        Assertion::nullOrNumeric($altitude);

        $altitude = $altitude === null ? $altitude : (float) $altitude;

        return new self((float) $latitude, (float) $longitude, $altitude);
    }

    public function latitude(): float
    {
        return $this->latitude;
    }

    public function longitude(): float
    {
        return $this->longitude;
    }

    public function altitude(): float|null
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
    public function equals(LatLng $other, int|null $maxMargin = null, bool $ignoreAltitude = true): bool
    {
        if ($maxMargin !== null) {
            $margin = max(
                abs($this->latitude() - $other->latitude()),
                abs($this->longitude() - $other->longitude()),
            );

            $altitude = $this->altitude();
            if (! $ignoreAltitude && $altitude !== null) {
                $margin = max(
                    $margin,
                    abs($altitude - $other->longitude()),
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
     * {@inheritDoc}
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
