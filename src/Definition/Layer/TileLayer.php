<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\NumberConstraint;
use Cowegis\Core\Constraint\OrConstraint;
use Cowegis\Core\Constraint\StringConstraint;

final class TileLayer extends GridLayer
{
    /** @var string */
    private $urlTemplate;

    public function __construct(LayerId $layerId, string $name, string $urlTemplate, bool $initialVisible)
    {
        parent::__construct($layerId, $name, $initialVisible);

        $this->urlTemplate = $urlTemplate;
    }

    public function urlTemplate() : string
    {
        return $this->urlTemplate;
    }

    protected function optionConstraints() : array
    {
        $constraints = parent::optionConstraints();

        $constraints['maxZoom']      = NumberConstraint::withDefaultValue(18);
        $constraints['subdomains']   = StringConstraint::withDefaultValue('abc');
        $constraints['errorTileUrl'] = StringConstraint::withDefaultValue('');
        $constraints['zoomOffset']   = NumberConstraint::withDefaultValue(0);
        $constraints['tms']          = BooleanConstraint::withDefaultValue(false);
        $constraints['zoomReverse']  = BooleanConstraint::withDefaultValue(false);
        $constraints['detectRetina'] = BooleanConstraint::withDefaultValue(false);
        $constraints['crossOrigin']  = OrConstraint::withDefaultValue(
            false,
            new BooleanConstraint(),
            new StringConstraint()
        );

        return $constraints;
    }
}
