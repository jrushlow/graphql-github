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
        return sprintf('%s %s', $this->type->name, (string) $this->selectionSet);
    }
}
