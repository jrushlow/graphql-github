<?php

namespace Jrushlow\GraphqlGithub\Abstraction;

/**
 * @author Jesse Rushlow <jr@rushlow.dev>
 */
class Field implements \Stringable
{
    public function __construct(
        public readonly string $name,
        public readonly ?string $alias = null,
        public readonly ?Arguments $arguments = null,
        public readonly ?SelectionSet $selectionSet = null,
    ) {
    }

    public function __toString(): string
    {
        $string = null !== $this->alias ? "$this->alias: $this->name" : $this->name;

        if (null !== $this->arguments) {
            $string .= $this->arguments->__toString();
        }

        if (null !== $this->selectionSet) {
            $string .= sprintf(' %s', $this->selectionSet);
        }

        return $string;
    }
}
