<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter\Rule;

use Cowegis\Core\Filter\Query;
use Cowegis\Core\Filter\Rule;
use Override;

final class KeywordRule implements Rule
{
    public const QUERY_PARAM = 'keyword';

    public function __construct(private readonly string $keyword)
    {
    }

    #[Override]
    public function name(): string
    {
        return self::QUERY_PARAM;
    }

    public function keyword(): string
    {
        return $this->keyword;
    }

    #[Override]
    public function toQuery(Query $query): Query
    {
        return $query->with($this->name(), $this->keyword);
    }
}
