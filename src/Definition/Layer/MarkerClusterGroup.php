<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use Cowegis\Core\Constraint\ArrayConstraint;
use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\FloatConstraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\IntegerConstraint;
use Cowegis\Core\Definition\Expression\Reference;

final class MarkerClusterGroup extends FeatureGroup
{
    protected function optionConstraints() : array
    {
        $constraints = parent::optionConstraints();

        $constraints['showCoverageOnHover']        = BooleanConstraint::withDefaultValue(true);
        $constraints['zoomToBoundsOnClick']        = BooleanConstraint::withDefaultValue(true);
        $constraints['spiderfyOnMaxZoom']          = BooleanConstraint::withDefaultValue(true);
        $constraints['removeOutsideVisibleBounds'] = BooleanConstraint::withDefaultValue(true);
        $constraints['animate']                    = BooleanConstraint::withDefaultValue(true);
        $constraints['spiderLegPolylineOptions']   = ArrayConstraint::withDefaultValue(
            ['weight' => 1.5, 'color' => '#222', 'opacity' => 0.5]
        );
        $constraints['iconCreateFunction']         = new InstanceOfConstraint(Reference::class);
        $constraints['spiderfyShapePositions']     = new InstanceOfConstraint(Reference::class);
        $constraints['animateAddingMarkers']       = BooleanConstraint::withDefaultValue(false);
        $constraints['disableClusteringAtZoom']    = new FloatConstraint();
        $constraints['maxClusterRadius']           = IntegerConstraint::withDefaultValue(80);
        $constraints['polygonOptions']             = new ArrayConstraint();
        $constraints['singleMarkerMode']           = BooleanConstraint::withDefaultValue(false);
        $constraints['disableClusteringAtZoom']    = FloatConstraint::withDefaultValue(1);
        $constraints['clusterPane']                = FloatConstraint::withDefaultValue(1);
        $constraints['chunkedLoading']             = BooleanConstraint::withDefaultValue(false);
        $constraints['chunkInterval']              = IntegerConstraint::withDefaultValue(200);
        $constraints['chunkDelay']                 = IntegerConstraint::withDefaultValue(50);
        $constraints['chunkProgress']              = new InstanceOfConstraint(Reference::class);

        return $constraints;
    }
}
