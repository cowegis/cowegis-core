<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter;

interface Rule
{
    public function name(): string;

    public function toQuery(Query $query): Query;
}
