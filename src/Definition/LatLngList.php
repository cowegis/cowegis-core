<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use ArrayIterator;
use Assert\Assertion;
use Countable;
use IteratorAggregate;
use JsonSerializable;
use Traversable;

use function array_merge;
use function array_values;
use function count;

/**
 * @psalm-import-type TSerializedLatLng from LatLng
 * @psalm-type TSerializedLatLngList = list<TSerializedLatLng>
 * @implements IteratorAggregate<int, LatLng>
 */
final class LatLngList implements IteratorAggregate, Countable, JsonSerializable
{
    /** @param list<LatLng> $latLngs */
    public function __construct(private readonly array $latLngs)
    {
        Assertion::allIsInstanceOf($this->latLngs, LatLng::class);
    }

    public function add(LatLng ...$latLngs): self
    {
        return new self(array_values(array_merge($this->latLngs, $latLngs)));
    }

    public function count(): int
    {
        return count($this->latLngs);
    }

    /** @return list<LatLng> */
    public function all(): array
    {
        return $this->latLngs;
    }

    /** @return Traversable<int, LatLng> */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->latLngs);
    }

    public function bounds(): LatLngBounds
    {
        return LatLngBounds::fromCoordinates($this->latLngs);
    }

    /** @return TSerializedLatLngList */
    public function jsonSerialize(): array
    {
        $serialized = [];

        foreach ($this->latLngs as $latLng) {
            $serialized[] = $latLng->jsonSerialize();
        }

        return $serialized;
    }
}
