<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use function method_exists;

trait TitlePlugin
{
    /**
     * The title.
     *
     * @var string
     */
    private $title;

    /**
     * Set the title.
     *
     * @param string $label The new title.
     */
    public function changeTitle(string $label) : void
    {
        $this->title = $label;
    }

    /**
     * Get elements title.
     *
     * @return string
     */
    public function title() : ?string
    {
        if ($this->title !== null) {
            return $this->title;
        }

        if (method_exists($this, 'name')) {
            return $this->name();
        }

        return null;
    }
}
