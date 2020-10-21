<?php

declare(strict_types=1);

namespace Cowegis\Core\Serializer;

interface Serializer
{
    /**
     * @param mixed $data
     *
     * @return mixed
     */
    public function serialize($data);
}
