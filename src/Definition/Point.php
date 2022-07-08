<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use JsonSerializable;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.ShortMethodName)
 */
final class Point implements Compareable, JsonSerializable
{
    private int $x;

    private int $y;

    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /** @param int[] $point */
    public static function fromArray(array $point): self
    {
        return new self(...$point);
    }

    public function x(): int
    {
        return $this->x;
    }

    public function y(): int
    {
        return $this->y;
    }

    public function equals(Compareable $other): bool
    {
        if (! $other instanceof self) {
            return false;
        }

        return $other->x === $this->x && $this->y === $other->y;
    }

    /** @return array<int, int> */
    public function jsonSerialize(): array
    {
        return [$this->x, $this->y];
    }
}
