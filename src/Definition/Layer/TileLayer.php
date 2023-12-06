<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Layer;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\NumberConstraint;
use Cowegis\Core\Constraint\OrConstraint;
use Cowegis\Core\Constraint\StringConstraint;

final class TileLayer extends GridLayer
{
    public function __construct(
        LayerId $layerId,
        string $name,
        private readonly string $urlTemplate,
        bool $initialVisible,
    ) {
        parent::__construct($layerId, $name, $initialVisible);
    }

    public function urlTemplate(): string
    {
        return $this->urlTemplate;
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
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
            new StringConstraint(),
        );

        return $constraints;
    }
}
