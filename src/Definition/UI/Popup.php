<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\UI;

use Cowegis\Core\Constraint\Constraint;
use Cowegis\Core\Definition\HasPopup;
use Cowegis\Core\Definition\Map\Map;
use Cowegis\Core\Definition\Preset\PopupPresetId;

final class Popup extends DivOverlay
{
    use PopupOptionsPlugin;

    public function __construct(private readonly string $content, private readonly PopupPresetId|null $presetId = null)
    {
    }

    public function openOn(HasPopup $target): void
    {
        $target->openPopup($this);
    }

    public function addTo(Map $map): void
    {
        $map->openPopup($this);
    }

    public function content(): string
    {
        return $this->content;
    }

    public function presetId(): PopupPresetId|null
    {
        return $this->presetId;
    }

    /** @return array<string, Constraint> */
    protected function optionConstraints(): array
    {
        $constraints = parent::optionConstraints();

        return $this->popupOptionsConstraints($constraints);
    }
}
