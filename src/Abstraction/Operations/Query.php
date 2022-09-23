<?php

namespace Jrushlow\GraphqlGithub\Abstraction\Operations;

use Jrushlow\GraphqlGithub\Abstraction\SelectionSet;

/**
 * @author Jesse Rushlow <jr@rushlow.dev>
 */
class Query
{
    public function __construct(
        public readonly SelectionSet $selections,
        public readonly ?string $name = null,
    ) {
    }
}
