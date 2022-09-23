<?php

namespace Jrushlow\GraphqlGithub\Abstraction;

/**
 * @author Jesse Rushlow <jr@rushlow.dev>
 */
class SelectionSet implements \Stringable
{
    /**
     * @param array<int, Selection> $selections
     */
    public function __construct(
        public readonly array $selections,
    ) {
        foreach ($this->selections as $selection) {
            if (!$selection instanceof Selection) {
                throw new \RuntimeException('Invalid Selection in array');
            }
        }
    }

    public function __toString(): string
    {

        return implode('', $this->selections);
    }
}
