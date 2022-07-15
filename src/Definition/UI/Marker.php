<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\UI;

use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Constraint\FloatConstraint;
use Cowegis\Core\Constraint\InstanceOfConstraint;
use Cowegis\Core\Constraint\IntegerConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Definition;
use Cowegis\Core\Definition\Event\EventsPlugin;
use Cowegis\Core\Definition\GeoData\Properties;
use Cowegis\Core\Definition\HasEvents;
use Cowegis\Core\Definition\HasOptions;
use Cowegis\Core\Definition\HasPopup;
use Cowegis\Core\Definition\HasTitle;
use Cowegis\Core\Definition\HasTooltip;
use Cowegis\Core\Definition\Icon\Icon;
use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\Map\PaneId;
use Cowegis\Core\Definition\NamePlugin;
use Cowegis\Core\Definition\OptionsPlugin;
use Cowegis\Core\Definition\Point;
use Cowegis\Core\Definition\PopupPlugin;
use Cowegis\Core\Definition\TitlePlugin;
use Cowegis\Core\Definition\TooltipPlugin;

final class Marker implements Definition, HasOptions, HasEvents, HasTitle, HasPopup, HasTooltip
{
    use EventsPlugin;
    use NamePlugin;
    use OptionsPlugin;
    use TitlePlugin;
    use PopupPlugin;
    use TooltipPlugin;

    private MarkerId $markerId;

    private LatLng $coordinates;

    private Properties $properties;

    private ?Icon $icon = null;

    public function __construct(MarkerId $markerId, string $name, LatLng $coordinates)
    {
        $this->markerId    = $markerId;
        $this->name        = $name;
        $this->coordinates = $coordinates;
        $this->properties  = new Properties();
    }

    public function markerId(): MarkerId
    {
        return $this->markerId;
    }

    public function coordinates(): LatLng
    {
        return $this->coordinates;
    }

    public function properties(): Properties
    {
        return $this->properties;
    }

    public function customizeIcon(Icon $icon): void
    {
        $this->icon = $icon;
    }

    public function icon(): ?Icon
    {
        return $this->icon;
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = [];

        $constraints['keyboard']            = BooleanConstraint::withDefaultValue(true);
        $constraints['title']               = StringConstraint::withDefaultValue('');
        $constraints['alt']                 = StringConstraint::withDefaultValue('');
        $constraints['zIndexOffset']        = IntegerConstraint::withDefaultValue(0);
        $constraints['opacity']             = FloatConstraint::withDefaultValue(1.0);
        $constraints['riseOnHover']         = BooleanConstraint::withDefaultValue(false);
        $constraints['riseOffset']          = IntegerConstraint::withDefaultValue(250);
        $constraints['pane']                = InstanceOfConstraint::withDefaultValue(PaneId::class, 'markerPane');
        $constraints['bubblingMouseEvents'] = BooleanConstraint::withDefaultValue(false);
        $constraints['draggable']           = BooleanConstraint::withDefaultValue(false);
        $constraints['autoPan']             = BooleanConstraint::withDefaultValue(false);
        $constraints['autoPanPadding']      = InstanceOfConstraint::withDefaultValue(Point::class, new Point(50, 50));
        $constraints['autoPanSpeed']        = IntegerConstraint::withDefaultValue(10);
        $constraints['interactive']         = BooleanConstraint::withDefaultValue(true);
        $constraints['attribution']         = new StringConstraint();

        return $constraints;
    }
}
