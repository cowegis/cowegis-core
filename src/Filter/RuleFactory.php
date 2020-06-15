<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter;

interface RuleFactory
{
    public function name() : string;

    public function supports(Query $query) : bool;

    public function create(Query $query) : Rule;
}
