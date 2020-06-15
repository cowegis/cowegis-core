<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter\Rule;

use Cowegis\Core\Filter\Query;
use Cowegis\Core\Filter\Rule;
use Cowegis\Core\Filter\RuleFactory;

final class KeywordRuleFactory implements RuleFactory
{
    public function name() : string
    {
        return 'keyword';
    }

    public function supports(Query $query) : bool
    {
        return $query->has($this->name());
    }

    public function create(Query $query) : Rule
    {
        return new KeywordRule($query->getString($this->name()));
    }
}
