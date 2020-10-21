<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Definition\Event\EventsPlugin;
use Cowegis\Core\Definition\Expression\Reference;
use Cowegis\Core\Definition\GeoJson\ExternalData;
use Cowegis\Core\Definition\GeoJson\GeoJsonData;
use Cowegis\Core\Definition\Map\PaneId;

final class DataLayer extends Layer
{
    use EventsPlugin;

    /** @var GeoJsonData|null */
    private $data;

    public function dataFromUri(ExternalData $dataUri): void
    {
        $this->data    = null;
        $this->dataUri = $dataUri;
    }

    public function withData(GeoJsonData $data): void
    {
        $this->data = $data;
    }

    public function data(): ?GeoJsonData
    {
        return $this->data;
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['pane']                  = InstanceOfConstraint::withDefaultValue(PaneId::class, 'overlayPane');
        $constraints['pointToLayer']          = new InstanceOfConstraint(Reference::class);
        $constraints['style']                 = new InstanceOfConstraint(Reference::class);
        $constraints['onEachFeature']         = new InstanceOfConstraint(Reference::class);
        $constraints['filter']                = new InstanceOfConstraint(Reference::class);
        $constraints['coordsToLatLng']        = new InstanceOfConstraint(Reference::class);
        $constraints['markersInheritOptions'] = BooleanConstraint::withDefaultValue(false);
        $constraints['adjustBounds']          = BooleanConstraint::withDefaultValue(false);

        return $constraints;
    }
}
