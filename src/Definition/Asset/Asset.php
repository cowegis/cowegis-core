<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Asset;

use JsonSerializable;

final class Asset implements JsonSerializable
{
    public const TYPE_JAVASCRIPT = 'javascript';

    public const TYPE_STYLESHEET = 'stylesheet';

    public const TYPE_CALLBACKS = 'callbacks';

    /** @var string */
    private $type;

    /** @var string */
    private $url;

    /** @var string|null */
    private $identifier;

    private function __construct(string $type, string $url)
    {
        $this->type = $type;
        $this->url  = $url;
    }

    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    public static function JAVASCRIPT(string $url): self
    {
        return new self(self::TYPE_JAVASCRIPT, $url);
    }

    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    public static function STYLESHEET(string $url): self
    {
        return new self(self::TYPE_STYLESHEET, $url);
    }

    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     */
    public static function CALLBACKS(string $identifier, string $url): self
    {
        $instance             = new self(self::TYPE_CALLBACKS, $url);
        $instance->identifier = $identifier;

        return $instance;
    }

    public function type(): string
    {
        return $this->type;
    }

    public function url(): string
    {
        return $this->url;
    }

    public function identifier(): ?string
    {
        return $this->identifier;
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        $data = [
            'type' => $this->type,
            'url'  => $this->url,
        ];

        if ($this->type === self::TYPE_CALLBACKS) {
            $data['identifier'] = $this->identifier;
        }

        return $data;
    }
}
