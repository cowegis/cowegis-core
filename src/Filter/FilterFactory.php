<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter;

use Generator;
use Psr\Http\Message\UriInterface;
use Traversable;

use function parse_str;

/** @psalm-import-type TParams from Query */
final class FilterFactory
{
    /** @var RuleFactory[] */
    private array $ruleFactories = [];

    /** @param RuleFactory[] $ruleFactories */
    public function __construct(iterable $ruleFactories)
    {
        foreach ($ruleFactories as $ruleFactory) {
            $this->ruleFactories[] = $ruleFactory;
        }
    }

    /**
     * @return Traversable<string>
     * @psalm-return Generator<string>
     */
    public function ruleNames(): Traversable
    {
        foreach ($this->ruleFactories as $factory) {
            yield $factory->name();
        }
    }

    public function createFromUri(UriInterface $uri): Filter
    {
        return $this->createFromQuery($this->createQuery($uri));
    }

    public function createFromQuery(Query $query): Filter
    {
        $filter = new Filter();

        foreach ($this->ruleFactories as $factory) {
            if (! $factory->supports($query)) {
                continue;
            }

            $filter->add($factory->create($query));
        }

        return $filter;
    }

    private function createQuery(UriInterface $uri): Query
    {
        $query = [];
        parse_str($uri->getQuery(), $query);
        /** @psalm-var TParams $query */

        return Query::fromArray($query);
    }
}
