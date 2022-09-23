<?php

namespace Jrushlow\GraphqlGithubTests\Unit\Abstraction;

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
class SerializationTest extends TestCase
{
    public function testJsonSerializationWithEmptyOperation(): void
    {
        $document = new Document([
            new Operation(OperationType::Query, new SelectionSet([])),
        ]);

        self::assertSame('{"Query":"{ }"}', json_encode($document, \JSON_THROW_ON_ERROR));
    }

    public function testJsonSerializationWithSingleOperation(): void
    {
        $document = new Document([
            new Operation(OperationType::Query, new SelectionSet([new Selection(new Field('firstName'))])),
        ]);

        self::assertSame('{"Query":"{ firstName }"}', json_encode($document, \JSON_THROW_ON_ERROR));
    }

    public function testJsonSerializationWithMultipleOperation(): void
    {
        $document = new Document([
            new Operation(OperationType::Query, new SelectionSet([new Selection(new Field('firstName'))])),
            new Operation(OperationType::Mutation, new SelectionSet([new Selection(new Field('lastName'))])),
        ]);

        self::assertSame('{"Query":"{ firstName }","Mutation":"{ lastName }"}', json_encode($document, \JSON_THROW_ON_ERROR));
    }
}
