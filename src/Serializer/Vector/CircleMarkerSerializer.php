<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer\Vector;

use Override;

final class CircleMarkerSerializer extends CircleObjectSerializer
{
    #[Override]
    protected function serializedType(): string
    {
        return 'circleMarker';
    }
}
