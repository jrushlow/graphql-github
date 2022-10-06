<?php

namespace Jrushlow\GraphqlGithubTests\Unit\Abstraction;

use Jrushlow\GraphqlGithub\Abstraction\Argument;
use Jrushlow\GraphqlGithub\Abstraction\Arguments;
use Jrushlow\GraphqlGithub\Abstraction\Document;
use Jrushlow\GraphqlGithub\Abstraction\Field;
use Jrushlow\GraphqlGithub\Abstraction\Operation;
use Jrushlow\GraphqlGithub\Abstraction\Selection;
use Jrushlow\GraphqlGithub\Abstraction\SelectionSet;
use Jrushlow\GraphqlGithub\Abstraction\Type\OperationType;
use PHPUnit\Framework\TestCase;

/**
 * @author Jesse Rushlow <jr@rushlow.dev>
 */
class ToStringTest extends TestCase
{
    public function testArgument(): void
    {
        $argument = new Argument('developer', 'Jesse');

        self::assertSame('developer: Jesse', (string) $argument);
    }

    public function testEmptyArguments(): void
    {
        $arguments = new Arguments([]);

        self::assertSame('()', (string) $arguments);
    }

    public function testArgumentsWithSingleArgument(): void
    {
        $arguments = new Arguments([new Argument('developer', 'Jesse')]);

        self::assertSame('(developer: Jesse)', (string) $arguments);
    }

    public function testArgumentsWithMultipleArguments(): void
    {
        $arguments = new Arguments([
            new Argument('developer', 'Jesse'),
            new Argument('workingOn', 'GraphQL'),
        ]);

        self::assertSame('(developer: Jesse, workingOn: GraphQL)', (string) $arguments);
    }

    public function testField(): void
    {
        $field = new Field(name: 'firstName');

        self::assertSame('firstName', (string) $field);
    }

    public function testFieldWithSelectionSet(): void
    {
        $selections = new SelectionSet([new Selection(new Field('login'))]);

        $field = new Field(name: 'firstName', selectionSet: $selections);

        self::assertSame('firstName { login }', (string) $field);
    }

    public function testFieldWithArgument(): void
    {
        $field = new Field(
            name: 'firstName',
            arguments: new Arguments([
                new Argument('name', 'Jesse'),
        ]));

        self::assertSame('firstName(name: Jesse)', (string) $field);
    }

    public function testFieldWithAlias(): void
    {
        $field = new Field(name: 'firstName', alias: 'developer');

        self::assertSame('developer: firstName', (string) $field);
    }

    public function testFieldWithArgumentAndAlias(): void
    {
        $field = new Field(
            name: 'firstName',
            alias: 'developer',
            arguments: new Arguments([
                new Argument('name', 'Jesse'),
            ])
        );

        self::assertSame('developer: firstName(name: Jesse)', (string) $field);
    }

    public function testSelection(): void
    {
        $selection = new Selection(new Field(name: 'name'));

        self::assertSame('name', (string) $selection);
    }

    public function testSelectionSetWithoutSelection(): void
    {
        $set = new SelectionSet([]);

        self::assertSame('{ }', (string) $set);
    }

    public function testSelectionSetWithSingleSelection(): void
    {
        $set = new SelectionSet([
            new Selection(new Field('name')),
        ]);

        self::assertSame('{ name }', (string) $set);
    }

    public function testSelectionSetWithMultipleSelection(): void
    {
        $set = new SelectionSet([
            new Selection(new Field('name')),
            new Selection(new Field('title')),
        ]);

        self::assertSame('{ name title }', (string) $set);
    }

    public function testOperationWithEmptySelectionSet(): void
    {
        $operation = new Operation(OperationType::Query, new SelectionSet([]));

        self::assertSame('Query { }', (string) $operation);
    }

    public function testOperationWithSelectionSet(): void
    {
        $operation = new Operation(OperationType::Query, new SelectionSet([
            new Selection(new Field('GraphQL')),
        ]));

        self::assertSame('Query { GraphQL }', (string) $operation);
    }

    public function testDocumentWithoutOperations(): void
    {
        $document = new Document([]);

        self::assertSame('{ }', (string) $document);
    }

    public function testDocumentWithOneOperations(): void
    {
        $document = new Document([new Operation(OperationType::Query, new SelectionSet([]))]);

        self::assertSame('{ Query { } }', (string) $document);
    }

    public function testDocumentWithMultipleOperations(): void
    {
        $document = new Document([
            new Operation(OperationType::Query, new SelectionSet([])),
            new Operation(OperationType::Query, new SelectionSet([])),
        ]);

        self::assertSame('{ Query { } Query { } }', (string) $document);
    }
}
