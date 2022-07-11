<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use Assert\Assertion;
use Cowegis\Core\Exception\RuntimeException;
use Cowegis\GeoJson\Position\Coordinates;
use InvalidArgumentException;

use function array_map;
use function array_shift;
use function count;
use function explode;
use function sprintf;

/**
 * @psalm-import-type TSerializedLatLng from LatLng
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
final class LatLngBounds
{
    /**
     * South west boundary.
     */
    private LatLng $southWest;

    /**
     * North east boundary.
     */
    private LatLng $northEast;

    /**
     * Construct.
     *
     * @param LatLng $southWest South west corner of the bounds.
     * @param LatLng $northEast North east corner of the bounds.
     */
    public function __construct(LatLng $southWest, LatLng $northEast)
    {
        $this->southWest = $southWest;
        $this->northEast = $northEast;
    }

    /**
     * Create from native array format.
     *
     * @param array<int, array<int, float>> $native The native boundary
     * @psalm-param array{0: TSerializedLatLng, 1: TSerializedLatLng} $native
     *
     * @throws InvalidArgumentException If the array format is not supported.
     */
    public static function fromArray(array $native): self
    {
        if (! isset($native[0], $native[1])) {
            throw new InvalidArgumentException('LatLngBounds array format not supported.');
        }

        return new static(
            LatLng::fromArray($native[0]),
            LatLng::fromArray($native[1])
        );
    }

    /**
     * Create from a string format.
     *
     * @param string $native    Bounds string representation.
     * @param string $separator Separator string of each value.
     *
     * @throws InvalidArgumentException If an invalid value is given.
     */
    public static function fromString(string $native, string $separator = ','): self
    {
        $values = explode($separator, $native, 4);

        if (count($values) !== 4) {
            throw new InvalidArgumentException(
                sprintf('LatLngBounds can not be created from string "%s"', $native)
            );
        }

        $values = array_map('floatval', $values);

        return new LatLngBounds(
            new LatLng($values[0], $values[1]),
            new LatLng($values[2], $values[3])
        );
    }

    /** @param list<LatLng> $latLngs */
    public static function fromCoordinates(array $latLngs): self
    {
        Assertion::allIsInstanceOf($latLngs, LatLng::class);

        if ($latLngs === []) {
            throw new RuntimeException('Cannot determine bounds from empty list of coordinates');
        }

        $first     = array_shift($latLngs);
        $southWest = $first;
        $northEast = $first;

        foreach ($latLngs as $latLng) {
            if ($latLng->longitude() < $southWest->longitude()) {
                $southWest = new LatLng($southWest->latitude(), $latLng->longitude());
            }

            if ($latLng->latitude() > $northEast->latitude()) {
                $southWest = new LatLng($latLng->latitude(), $southWest->longitude());
            }

            if ($latLng->longitude() > $northEast->longitude()) {
                $northEast = new LatLng($northEast->latitude(), $latLng->longitude());
            }

            // phpcs:ignore SlevomatCodingStandard.ControlStructures.EarlyExit.EarlyExitNotUsed
            if ($latLng->latitude() < $northEast->latitude()) {
                $northEast = new LatLng($latLng->latitude(), $northEast->longitude());
            }
        }

        return new self($southWest, $northEast);
    }

    /**
     * Get south west corner.
     */
    public function southWest(): LatLng
    {
        return $this->southWest;
    }

    /**
     * Get south east corner.
     */
    public function southEast(): LatLng
    {
        return new LatLng($this->southWest->latitude(), $this->northEast->longitude());
    }

    /**
     * Get north east corner.
     */
    public function northEast(): LatLng
    {
        return $this->northEast;
    }

    /**
     * Get south east corner.
     */
    public function northWest(): LatLng
    {
        return new LatLng($this->northEast->latitude(), $this->southWest->longitude());
    }

    /**
     * Get west longitude.
     */
    public function west(): float
    {
        return $this->southWest->longitude();
    }

    /**
     * Get south latitude.
     */
    public function south(): float
    {
        return $this->southWest->latitude();
    }

    /**
     * Get east longitude.
     */
    public function east(): float
    {
        return $this->northEast->longitude();
    }

    /**
     * Get north latitude.
     */
    public function north(): float
    {
        return $this->northEast->latitude();
    }

    /**
     * Get the center of the bounding box.
     */
    public function center(): LatLng
    {
        return new LatLng(
            $this->north() - $this->south(),
            $this->west() - $this->east()
        );
    }

    /**
     * Compare two bounds.
     *
     * @param LatLngBounds $other The other bounds.
     */
    public function equals(LatLngBounds $other): bool
    {
        if (! $this->northEast()->equals($other->northEast())) {
            return false;
        }

        return $this->southWest()->equals($other->southWest());
    }

    /**
     * Check if bounds overlaps.
     *
     * @param LatLngBounds $other The over bounds to check.
     */
    public function overlaps(LatLngBounds $other): bool
    {
        $southWest = $other->southWest();
        $northEast = $other->northEast();

        $latOverlaps = ($northEast->latitude() > $this->southWest->latitude())
            && ($southWest->latitude() < $this->northEast->latitude());

        if (! $latOverlaps) {
            return false;
        }

        return ($northEast->longitude() > $this->southWest->longitude())
            && ($southWest->longitude() < $northEast->longitude());
    }

    /**
     * Check if bounds intersects.
     *
     * @param LatLngBounds $other The other bounds.
     */
    public function intersects(LatLngBounds $other): bool
    {
        $southWest = $other->southWest();
        $northEast = $other->northEast();

        $latOverlaps = ($northEast->latitude() >= $this->southWest->latitude())
            && ($southWest->latitude() <= $this->northEast->latitude());

        $lngOverlaps = ($northEast->longitude() >= $this->southWest->longitude())
            && ($southWest->longitude() <= $northEast->longitude());

        return $latOverlaps && $lngOverlaps;
    }

    /**
     * Get value as valid json string.
     *
     * @return array<int, array<int, float>>
     */
    public function jsonSerialize(): array
    {
        return [
            $this->southWest()->jsonSerialize(),
            $this->northEast()->jsonSerialize(),
        ];
    }

    /**
     * Get bounds as geo json coordinate.
     *
     * @return array<int, Coordinates>
     */
    public function toGeoJson(): array
    {
        return [
            $this->southWest()->toGeoJson(),
            $this->northEast()->toGeoJson(),
        ];
    }

    /**
     * Create a string representation.
     *
     * @param bool $ignoreAltitude If true the altitude is not included.
     */
    public function toString(bool $ignoreAltitude = false): string
    {
        return sprintf(
            '%s,%s',
            $this->southWest()->toString($ignoreAltitude),
            $this->northEast()->toString($ignoreAltitude)
        );
    }

    /**
     * Check if given object in in the bounds.
     *
     * @param LatLng $latLng The given object.
     */
    public function containsCoordinate(LatLng $latLng): bool
    {
        $lat = $latLng->latitude();
        $lng = $latLng->longitude();

        if ($this->west() > $lng || $this->east() < $lng) {
            return false;
        }

        return $this->south() <= $lat && $this->north() >= $lat;
    }
}
