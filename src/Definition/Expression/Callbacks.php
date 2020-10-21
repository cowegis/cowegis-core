<?php

declare(strict_types=1);

namespace Cowegis\Core\Definition\Expression;

use Countable;

use function count;
use function implode;
use function is_numeric;
use function sprintf;

final class Callbacks implements Countable
{
    private const JS_TEMPLATE = <<<'JAVASCRIPT'
export default {
  %s
};
JAVASCRIPT;

    /** @var Expression[] */
    private $callbacks = [];

    /** @var int */
    private $prefix = 0;

    /** @var string */
    private $identifier;

    public function __construct(string $identifier)
    {
        $this->identifier = is_numeric($identifier) ? 'callbacks_' . $identifier : $identifier;
    }

    public function identifier(): string
    {
        return $this->identifier;
    }

    public function add(Expression $expression): Reference
    {
        do {
            $this->prefix++;
            $identifier = 'callback_' . $this->prefix;
        } while (isset($this->callbacks[$identifier]));

        $this->callbacks[$identifier] = $expression;

        return new Reference($identifier, [$this->identifier]);
    }

    public function count(): int
    {
        return count($this->callbacks);
    }

    public function asJavascript(): string
    {
        $references = [];
        foreach ($this->callbacks as $identifier => $callback) {
            $references[] = sprintf('  %s: %s', $identifier, $callback->toString());
        }

        return sprintf(self::JS_TEMPLATE, implode(',' . "\n", $references));
    }
}
