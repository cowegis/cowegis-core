<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Control;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\EnumConstraint;
use Cowegis\Core\Constraint\IntegerConstraint;
use Cowegis\Core\Constraint\StringConstraint;

/**
 * @psalm-type TCustomGeocoder = array{
 *     type: string,
 *     options: array<string,mixed>
 * }
 */
final class GeocoderControl extends Control
{
    /** @var TCustomGeocoder|null */
    private array|null $geocoder = null;

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        $constraints['collapsed']          = BooleanConstraint::withDefaultValue(true);
        $constraints['defaultMarkGeocode'] = BooleanConstraint::withDefaultValue(true);
        $constraints['errorMessage']       = StringConstraint::withDefaultValue(null);
        $constraints['expand']             = EnumConstraint::withDefaultValue(['touch', 'click', 'hover'], 'touch');
        $constraints['iconLabel']          = StringConstraint::withDefaultValue(null);
        $constraints['placeholder']        = StringConstraint::withDefaultValue(null);
        $constraints['query']              = StringConstraint::withDefaultValue('');
        $constraints['queryMinLength']     = IntegerConstraint::withDefaultValue(1);
        $constraints['showResultIcons']    = BooleanConstraint::withDefaultValue(false);
        $constraints['showUniqueResult']   = BooleanConstraint::withDefaultValue(true);
        $constraints['suggestMinLength']   = IntegerConstraint::withDefaultValue(3);
        $constraints['suggestTimeout']     = IntegerConstraint::withDefaultValue(250);

        return $constraints;
    }

    protected function defaultPosition(): string|null
    {
        return Control::POSITION_TOP_RIGHT;
    }

    /** @param array<string,string> $options */
    public function useGeocoder(string $type, array $options = []): void
    {
        $this->geocoder = ['type' => $type, 'options' => $options];
    }

    /** @return TCustomGeocoder|null */
    public function geocoder(): array|null
    {
        return $this->geocoder;
    }
}
