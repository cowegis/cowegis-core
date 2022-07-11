<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

final class CircleSerializer extends CircleObjectSerializer
{
    protected function serializedType(): string
    {
        return 'circle';
    }
}
