<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter\Rule;

use Cowegis\Core\Filter\Query;
use Cowegis\Core\Filter\Rule;

final class KeywordRule implements Rule
{
    public const QUERY_PARAM = 'keyword';

    public function __construct(private readonly string $keyword)
    {
    }

    public function name(): string
    {
        return self::QUERY_PARAM;
    }

    public function keyword(): string
    {
        return $this->keyword;
    }

    public function toQuery(Query $query): Query
    {
        return $query->with($this->name(), $this->keyword);
    }
}
