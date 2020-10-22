<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter\Rule;

use Cowegis\Core\Definition\LatLng;
use Cowegis\Core\Definition\LatLngBounds;
use Cowegis\Core\Filter\Query;
use Cowegis\Core\Filter\Rule;
use Cowegis\Core\Filter\RuleFactory;

final class BboxRuleFactory implements RuleFactory
{
    public function name(): string
    {
        return 'bbox';
    }

    public function supports(Query $query): bool
    {
        if (! $query->has('bbox')) {
            return false;
        }

        $bbox = $query->getArray('bbox');

        return isset($bbox['from'], $bbox['to']);
    }

    public function create(Query $query): Rule
    {
        /** @psalm-var array{from: string, to: string} */
        $bbox        = $query->getArray('bbox');
        $boundingBox = new LatLngBounds(
            LatLng::fromString($bbox['from']),
            LatLng::fromString($bbox['to'])
        );

        return new BboxRule($boundingBox);
    }
}
