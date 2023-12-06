<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use function method_exists;

trait TitlePlugin
{
    /**
     * The title.
     */
    private string|null $title = null;

    /**
     * Set the title.
     *
     * @param string $label The new title.
     */
    public function changeTitle(string $label): void
    {
        $this->title = $label;
    }

    /**
     * Get elements title.
     */
    public function title(): string|null
    {
        if ($this->title !== null) {
            return $this->title;
        }

        if (method_exists($this, 'name')) {
            /** @psalm-suppress RedundantCast */
            return (string) $this->name();
        }

        return null;
    }
}
