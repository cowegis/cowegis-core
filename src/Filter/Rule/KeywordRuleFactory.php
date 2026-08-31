<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter\Rule;

use Cowegis\Core\Filter\Query;
use Cowegis\Core\Filter\Rule;
use Cowegis\Core\Filter\RuleFactory;
use Override;

final class KeywordRuleFactory implements RuleFactory
{
    #[Override]
    public function name(): string
    {
        return 'keyword';
    }

    #[Override]
    public function supports(Query $query): bool
    {
        return $query->has($this->name());
    }

    #[Override]
    public function create(Query $query): Rule
    {
        return new KeywordRule($query->getString($this->name()));
    }
}
