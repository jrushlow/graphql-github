<?php

namespace Jrushlow\GraphqlGithub\Abstraction;

/**
 * The top level GraphQL Document.
 *
 * @author Jesse Rushlow <jr@rushlow.dev>
 */
class Document implements \Stringable
{
    /**
     * @param array<int, Operation> $definitions
     */
    public function __construct(
        public readonly array $definitions = [],
    ) {
        foreach ($this->definitions as $definition) {
            if (!$definition instanceof Operation) {
                throw new \RuntimeException('Invalid Operation.');
            }
        }
    }

    public function __toString(): string
    {
        return empty($this->definitions) ? '{ }' : sprintf('{ %s }', implode(' ', $this->definitions));
    }
}
