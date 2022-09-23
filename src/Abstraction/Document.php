<?php

namespace Jrushlow\GraphqlGithub\Abstraction;

use Jrushlow\GraphqlGithub\Abstraction\Operations\Mutation;
use Jrushlow\GraphqlGithub\Abstraction\Operations\Query;

/**
 * The top level GraphQL Document
 *
 * @author Jesse Rushlow <jr@rushlow.dev>
 */
class Document
{
    public function __construct(
        private array $definitions = [],
    ) {
        foreach ($this->definitions as $definition) {
            if (!$definition instanceof Mutation && !$definition instanceof Query) {
                throw new \RuntimeException('Only Mutations and Queries operation accepted.');
            }
        }
    }

    /** @return array<int, \Jrushlow\GraphqlGithub\Abstraction\Operations\Query|\Jrushlow\GraphqlGithub\Abstraction\Operations\Mutation> */
    public function getDefinitions(): array
    {
        return $this->definitions;
    }

    public function addDefinition(Mutation|Query $definition): self
    {
        $this->definitions[] = $definition;

        return $this;
    }
}
