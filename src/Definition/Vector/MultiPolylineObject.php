<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Vector;

use Assert\Assertion;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LatLngBounds;
use Cowegis\Core\Definition\LatLngList;
use Cowegis\Core\Definition\Layer\LayerId;
use Cowegis\Core\Exception\InvalidArgument;
use Cowegis\GeoJson\Geometry\MultiLineString;
use Cowegis\GeoJson\Position\MultiCoordinates;
use Cowegis\GeoJson\Position\MultiLineCoordinates;

use function array_key_exists;
use function count;

abstract class MultiPolylineObject extends PolylineObject
{
    /** @var list<LatLngList> */
    private array $latLngs;

    protected ?LatLngBounds $bounds = null;

    /** @param list<LatLngList> $latLngs */
    public function __construct(LayerId $layerId, string $name, array $latLngs, bool $initialVisible = true)
    {
        parent::__construct($layerId, $name, $initialVisible);

        $this->setLatLngs($latLngs);
    }

    /** @return list<LatLngList> */
    public function getLatLngs(): array
    {
        return $this->latLngs;
    }

    /** @param list<LatLngList> $latLngs */
    final public function setLatLngs(array $latLngs): self
    {
        Assertion::allIsInstanceOf($latLngs, LatLngList::class);

        $this->latLngs = $latLngs;
        $this->bounds  = null;

        return $this;
    }

    public function addLatLng(LatLng $latLng, int $ringIndex): self
    {
        if (! array_key_exists($ringIndex, $this->latLngs)) {
            throw new InvalidArgument('Ring ' . $ringIndex . ' does not exist.');
        }

        /** @psalm-suppress PropertyTypeCoercion */
        $this->latLngs[$ringIndex] = $this->latLngs[$ringIndex]->add($latLng);
        $this->bounds              = null;

        return $this;
    }

    public function toGeoJson(): MultiLineString
    {
        $rings = [];

        foreach ($this->latLngs as $ring) {
            $coordinates = [];

            foreach ($ring as $latLng) {
                $coordinates[] = $latLng->toGeoJson();
            }

            $rings[] = new MultiCoordinates(...$coordinates);
        }

        return new MultiLineString(new MultiLineCoordinates(...$rings));
    }

    public function isEmpty(): bool
    {
        return count($this->latLngs) === 0;
    }

    abstract public function getBounds(): LatLngBounds;
}
