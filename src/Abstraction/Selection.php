<?php

namespace Jrushlow\GraphqlGithub\Abstraction;

/**
 * @author Jesse Rushlow <jr@rushlow.dev>
 */
class Selection implements \Stringable
{
    public function __construct(
        public readonly Field $field,
    ) {
    }

    public function __toString(): string
    {
        return $this->field->__toString();
    }
}
