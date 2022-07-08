<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter;

use Iterator;

use function array_values;

final class RuleIterator implements Iterator
{
    /** @var Rule[] */
    private array $rules;

    private int $index = 0;

    /**
     * @param Rule[] $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = array_values($rules);
    }

    public function current(): Rule
    {
        return $this->rules[$this->index];
    }

    public function next(): void
    {
        $this->index++;
    }

    public function key(): int
    {
        return $this->index;
    }

    public function valid(): bool
    {
        return isset($this->rules[$this->index]);
    }

    public function rewind(): void
    {
        $this->index = 0;
    }
}
