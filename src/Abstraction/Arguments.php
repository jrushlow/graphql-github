<?php

namespace Jrushlow\GraphqlGithub\Abstraction;

/**
 * @author Jesse Rushlow <jr@rushlow.dev>
 */
class Arguments implements \Stringable
{
    /**
     * @param array<int, Argument> $arguments
     */
    public function __construct(
        public readonly array $arguments,
    ) {
        foreach ($this->arguments as $argument) {
            if (!$argument instanceof Argument) {
                throw new \RuntimeException('Invalid argument in array');
            }
        }
    }

    public function __toString(): string
    {
        return sprintf('(%s)', implode(', ', $this->arguments));
    }
}
