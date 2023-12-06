<?php

declare(strict_types=1);

namespace Cowegis\Core\Filter\Rule;

use Cowegis\Core\Definition\LatLngBounds;
use Cowegis\Core\Filter\Query;
use Cowegis\Core\Filter\Rule;

final class BboxRule implements Rule
{
    public const QUERY_PARAM = 'bbox';

    public function __construct(private readonly LatLngBounds $boundingBox)
    {
    }

    public function name(): string
    {
        return self::QUERY_PARAM;
    }

    public function boundingBox(): LatLngBounds
    {
        return $this->boundingBox;
    }

    public function toQuery(Query $query): Query
    {
        return $query->with(
            $this->name(),
            [
                'from' => $this->boundingBox->southWest()->toString(),
                'to'   => $this->boundingBox->northEast()->toString(),
            ],
        );
    }
}
