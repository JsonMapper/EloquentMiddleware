<?php

declare(strict_types=1);

namespace JsonMapper\EloquentMiddleware\Tests\Integration;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Schema\AbstractSchemaManager;
use Doctrine\DBAL\Schema\Column;
use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Types\Types;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use JsonMapper\Cache\NullCache;
use JsonMapper\EloquentMiddleware\EloquentMiddleware;
use JsonMapper\JsonMapperInterface;
use JsonMapper\ValueObjects\PropertyMap;
use JsonMapper\Wrapper\ObjectWrapper;
use Orchestra\Testbench\TestCase;

class EloquentMiddlewareTest extends TestCase
{
    /**
     * @covers \JsonMapper\EloquentMiddleware\EloquentMiddleware
     */
    public function testNonEloquentModelRetunsEmptyPropertyMap(): void
    {
        $middleware = new EloquentMiddleware(new NullCache());
        $propertyMap = new PropertyMap();
        $mapper = $this->createMock(JsonMapperInterface::class);

        $middleware->handle(new \stdClass(), new ObjectWrapper(new \stdClass()), $propertyMap, $mapper);

        self::assertEmpty($propertyMap->getIterator());
    }

    /**
     * @covers \JsonMapper\EloquentMiddleware\EloquentMiddleware
     */
    public function testColumnsFromTheDatabaseAreReturned(): void
    {
        $middleware = new EloquentMiddleware(new NullCache());
        $propertyMap = new PropertyMap();
        $mapper = $this->createMock(JsonMapperInterface::class);
        $model = $this->prepareMockedModel(new Column('id', Type::getType(Type::INTEGER)));

        $middleware->handle(new \stdClass(), new ObjectWrapper($model), $propertyMap, $mapper);

        self::assertTrue($propertyMap->hasProperty('id'));
        self::assertEquals('integer', $propertyMap->getProperty('id')->getType());
    }

    private function prepareMockedModel(Column ...$columns): Model
    {
        $platform = $this->createMock(AbstractPlatform::class);

        $schemaManager = $this->createMock(AbstractSchemaManager::class);
        $schemaManager->method('getDatabasePlatform')->willReturn($platform);
        $schemaManager->method('listTableColumns')->willReturn($columns);

        $dbConnection = $this->createMock(Connection::class);
        $dbConnection->method('getDoctrineSchemaManager')->willReturn($schemaManager);

        $model = $this->createMock(Model::class);
        $model->method('getConnection')->willReturn($dbConnection);
        $model->method('getDates')->willReturn([]);
        $model->method('getCasts')->willReturn([]);

        return $model;
    }
}
