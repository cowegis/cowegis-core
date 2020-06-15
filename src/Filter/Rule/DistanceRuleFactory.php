<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter\Rule;

use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Filter\Query;
use Cowegis\Core\Filter\Rule;
use Cowegis\Core\Filter\RuleFactory;

final class DistanceRuleFactory implements RuleFactory
{
    public function name() : string
    {
        return 'distance';
    }

    public function supports(Query $query) : bool
    {
        if (! $query->has($this->name())) {
            return false;
        }

        $data = $query->getArray($this->name());

        return isset($data['coordinates'], $data['radius']);
    }

    public function create(Query $query) : Rule
    {
        $data = $query->getArray($this->name());

        return new DistanceRule(LatLng::fromString($data['coordinates']), (int) $data['radius']);
    }
}
