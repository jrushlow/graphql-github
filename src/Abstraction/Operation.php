<?php

namespace Jrushlow\GraphqlGithub\Abstraction;

use Jrushlow\GraphqlGithub\Abstraction\Type\OperationType;

class Operation implements \Stringable
{
    public function __construct(
        public readonly OperationType $type,
        public readonly SelectionSet $selectionSet,
        public readonly ?string $name = null,
    ) {
    }

    public function __toString()
    {
        return sprintf('%s %s', ucfirst(strtolower($this->type->name)), $this->selectionSet);
    }
}
