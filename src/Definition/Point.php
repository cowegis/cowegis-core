<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition;

use JsonSerializable;
use Override;

/**
 * @SuppressWarnings(PHPMD.ShortVariable)
 * @SuppressWarnings(PHPMD.ShortMethodName)
 */
final class Point implements Compareable, JsonSerializable
{
    public function __construct(private readonly int $x, private readonly int $y)
    {
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

    #[Override]
    public function equals(Compareable $other): bool
    {
        if (! $other instanceof self) {
            return false;
        }

        return $other->x === $this->x && $this->y === $other->y;
    }

    /** @return array<int, int> */
    #[Override]
    public function jsonSerialize(): array
    {
        return [$this->x, $this->y];
    }
}
