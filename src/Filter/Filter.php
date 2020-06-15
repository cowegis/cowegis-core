<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter;

final class Filter
{
    /** @var Rule[] */
    private $rules = [];

    public function add(Rule $rule) : void
    {
        $this->rules[] = $rule;
    }

    public function rules() : RuleIterator
    {
        return new RuleIterator($this->rules);
    }

    public function toQuery() : Query
    {
        $query = new Query();

        foreach ($this->rules() as $rule) {
            $query = $rule->toQuery($query);
        }

        return $query;
    }
}
