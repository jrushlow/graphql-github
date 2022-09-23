<?php

namespace Jrushlow\GraphqlGithub\Abstraction;

/**
 * @author Jesse Rushlow <jr@rushlow.dev>
 */
class Argument implements \Stringable
{
    public function __construct(
        public readonly string $name,
        public readonly string $value,
    ) {
    }

    public function __toString(): string
    {
        return sprintf('%s: %s', $this->name, $this->value);
    }
}
