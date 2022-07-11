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
use function count;

/**
 * @psalm-import-type TSerializedLatLng from LatLng
 * @psalm-type TSerializedLatLngList = list<TSerializedLatLng>
 */
final class LatLngList implements IteratorAggregate, Countable, JsonSerializable
{
    /** @var list<LatLng> */
    private array $latLngs;

    /** @param list<LatLng> $latLngs */
    public function __construct(array $latLngs)
    {
        Assertion::allIsInstanceOf($latLngs, LatLng::class);

        $this->latLngs = $latLngs;
    }

    public function add(LatLng ...$latLngs): self
    {
        return new self(array_merge($this->latLngs, $latLngs));
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

    /** @return Traversable<LatLng> */
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
