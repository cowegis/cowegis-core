<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\IntegerConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Expression\Reference;

final class OverpassLayer extends Layer
{
    protected function optionConstraints() : array
    {
        $constraints = parent::optionConstraints();

        $constraints['query']         = StringConstraint::withDefaultValue(
            '(node(BBOX)[organic];node(BBOX)[second_hand];);out qt;'
        );
        $constraints['endpoint']      = StringConstraint::withDefaultValue('https://overpass-api.de/api/');
        $constraints['minZoom']       = IntegerConstraint::withDefaultValue(15);
        $constraints['onEachFeature'] = new InstanceOfConstraint(Reference::class);
        $constraints['pointToLayer']  = new InstanceOfConstraint(Reference::class);

        return $constraints;
    }

}
