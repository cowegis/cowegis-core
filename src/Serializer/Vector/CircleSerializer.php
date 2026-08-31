<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Override;

final class CircleSerializer extends CircleObjectSerializer
{
    #[Override]
    protected function serializedType(): string
    {
        return 'circle';
    }
}
