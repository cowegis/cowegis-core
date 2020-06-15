<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Map;

use Cowegis\Core\Constraint;
use Cowegis\Core\Definition\Asset\Assets;
use Cowegis\Core\Definition\Control\ControlCollection;
use Cowegis\Core\Definition\Control\Controls;
use Cowegis\Core\Definition\Definition;
use Cowegis\Core\Definition\DefinitionId;
use Cowegis\Core\Definition\Event\EventsPlugin;
use Cowegis\Core\Definition\Expression\Callbacks;
use Cowegis\Core\Definition\HasEvents;
use Cowegis\Core\Definition\HasOptions;
use Cowegis\Core\Definition\HasPopup;
use Cowegis\Core\Definition\HasTitle;
use Cowegis\Core\Definition\Layer;
use Cowegis\Core\Definition\Layer\Layers;
use Cowegis\Core\Definition\Options;
use Cowegis\Core\Definition\OptionsPlugin;
use Cowegis\Core\Definition\Point;
use Cowegis\Core\Definition\PopupPlugin;
use Cowegis\Core\Definition\TitlePlugin;

final class Map implements Definition, HasEvents, HasTitle, HasOptions, HasPopup
{
    use EventsPlugin;
    use TitlePlugin;
    use OptionsPlugin;
    use PopupPlugin;

    /** @var DefinitionId */
    private $mapId;

    /** @var Layers */
    private $layers;

    /** @var Controls */
    private $controls;

    /** @var Panes */
    private $panes;

    /** @var string */
    private $elementId;

    /** @var bool */
    private $locate;

    /** @var Options */
    private $locateOptions;

    /** @var Options */
    private $boundsOptions;

    /** @var Callbacks */
    private $callbacks;

    /** @var Assets */
    private $assets;

    /** @var View */
    private $view;

    /** @var Presets */
    private $presets;

    public function __construct(MapId $mapId, string $elementId)
    {
        $this->mapId         = $mapId;
        $this->elementId     = $elementId;
        $this->panes         = new Panes();
        $this->layers        = new Layers();
        $this->controls      = new ControlCollection();
        $this->locate        = false;
        $this->locateOptions = new Options(new Constraint\Constraints($this->locateOptionConstraints()));
        $this->boundsOptions = new Options(new Constraint\Constraints($this->boundOptionConstraints()));
        $this->view          = new View();
        $this->presets       = new Presets();
    }

    public function mapId() : MapId
    {
        return $this->mapId;
    }

    public function elementId() : string
    {
        return $this->elementId;
    }

    public function layers() : Layers
    {
        return $this->layers;
    }

    public function controls() : Controls
    {
        return $this->controls;
    }

    public function panes() : Panes
    {
        return $this->panes;
    }

    public function presets() : Presets
    {
        return $this->presets;
    }

    public function enableLocate() : Options
    {
        $this->locate = true;

        return $this->locateOptions;
    }

    public function locate() : bool
    {
        return $this->locate;
    }

    public function locateOptions() : Options
    {
        return $this->locateOptions;
    }

    public function boundsOptions() : Options
    {
        return $this->boundsOptions;
    }

    public function view() : View
    {
        return $this->view;
    }

    protected function optionConstraints() : array
    {
        return [
            'preferCanvas'           => Constraint\BooleanConstraint::withDefaultValue(false),
            'attributionControl'     => Constraint\BooleanConstraint::withDefaultValue(true),
            'zoomControl'            => Constraint\BooleanConstraint::withDefaultValue(true),
            'closePopupOnClick'      => Constraint\BooleanConstraint::withDefaultValue(true),
            'zoomSnap'               => Constraint\NumberConstraint::withDefaultValue(1),
            'zoomDelta'              => Constraint\NumberConstraint::withDefaultValue(1),
            'trackResize'            => Constraint\BooleanConstraint::withDefaultValue(true),
            'boxZoom'                => Constraint\BooleanConstraint::withDefaultValue(true),
            'doubleClickZoom'        => Constraint\OrConstraint::withDefaultValue(
                true,
                new Constraint\ValueConstraint('center'),
                new Constraint\BooleanConstraint()
            ),
            'dragging'               => Constraint\BooleanConstraint::withDefaultValue(true),
            'crs'                    => Constraint\StringConstraint::withDefaultValue('L.CRS.EPSG3857'),
            'center'                 => new Constraint\LatLngConstraint(),
            'zoom'                   => new Constraint\NumberConstraint(),
            'minZoom'                => new Constraint\NumberConstraint(),
            'maxZoom'                => new Constraint\NumberConstraint(),
            'layers'                 => new Constraint\ListConstraint(
                new Constraint\InstanceOfConstraint(Layer::class)
            ),
            'maxBounds'              => new Constraint\LatLngConstraint(),
            'zoomAnimation'          => Constraint\BooleanConstraint::withDefaultValue(true),
            'zoomAnimationThreshold' => Constraint\IntegerConstraint::withDefaultValue(4),
            'fadeAnimation'          => Constraint\BooleanConstraint::withDefaultValue(true),
            'markerZoomAnimation'    => Constraint\BooleanConstraint::withDefaultValue(true),
            'inertia'                => new Constraint\BooleanConstraint(),
            'inertiaDeceleration'    => Constraint\IntegerConstraint::withDefaultValue(3000),
            'inertiaMaxSpeed'        => new Constraint\IntegerConstraint(),
            'easeLinearity'          => Constraint\FloatConstraint::withDefaultValue(0.2),
            'worldCopyJump'          => Constraint\BooleanConstraint::withDefaultValue(false),
            'maxBoundsViscosity'     => Constraint\FloatConstraint::withDefaultValue(0.0),
            'keyboard'               => Constraint\BooleanConstraint::withDefaultValue(true),
            'keyboardPanDelta'       => Constraint\IntegerConstraint::withDefaultValue(80),
            'scrollWheelZoom'        => Constraint\OrConstraint::withDefaultValue(
                true,
                new Constraint\ValueConstraint('center'),
                new Constraint\BooleanConstraint()
            ),
            'wheelDebounceTime'      => Constraint\IntegerConstraint::withDefaultValue(40),
            'wheelPxPerZoomLevel'    => Constraint\IntegerConstraint::withDefaultValue(60),
            'tap'                    => Constraint\BooleanConstraint::withDefaultValue(true),
            'tapTolerance'           => Constraint\IntegerConstraint::withDefaultValue(15),
            'touchZoom'              => Constraint\OrConstraint::withDefaultValue(
                null,
                new Constraint\ValueConstraint('center'),
                new Constraint\BooleanConstraint()
            ),
            'bounceAtZoomLimits'     => Constraint\BooleanConstraint::withDefaultValue(true),
            'gestureHandling'        => Constraint\BooleanConstraint::withDefaultValue(false),
        ];
    }

    protected function locateOptionConstraints() : array
    {
        return [
            'watch'              => Constraint\BooleanConstraint::withDefaultValue(false),
            'setView'            => Constraint\BooleanConstraint::withDefaultValue(false),
            'maxZoom'            => new Constraint\FloatConstraint(),
            'timeout'            => Constraint\IntegerConstraint::withDefaultValue(10000),
            'maximumAge'         => Constraint\IntegerConstraint::withDefaultValue(0),
            'enableHighAccuracy' => Constraint\BooleanConstraint::withDefaultValue(false),
        ];
    }

    private function boundOptionConstraints() : array
    {
        return [
            'adjustAfterLoad'     => Constraint\BooleanConstraint::withDefaultValue(false),
            'adjustAfterDeferred' => Constraint\BooleanConstraint::withDefaultValue(false),
            'dynamic'             => Constraint\BooleanConstraint::withDefaultValue(false),
            'paddingTopLeft'      => new Constraint\InstanceOfConstraint(Point::class),
            'paddingBottomRight'  => new Constraint\InstanceOfConstraint(Point::class),
            'padding'             => new Constraint\InstanceOfConstraint(Point::class),
            'maxZoom'             => new Constraint\FloatConstraint(),
        ];
    }
}
