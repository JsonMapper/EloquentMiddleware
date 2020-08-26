<?php

declare(strict_types=1);

namespace JsonMapper\EloquentMiddleware\Tests\Integration;

use JsonMapper\Cache\NullCache;
use JsonMapper\EloquentMiddleware\EloquentMiddleware;
use JsonMapper\JsonMapperInterface;
use JsonMapper\ValueObjects\PropertyMap;
use JsonMapper\Wrapper\ObjectWrapper;
use JsonMapper\EloquentMiddleware\Tests\Implementation\EloquentModel;
use Orchestra\Testbench\TestCase;

class EloquentMiddlewareTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
$x = __DIR__ . '/../database/migrations';
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /**
     * @covers \JsonMapper\EloquentMiddleware\EloquentMiddleware
     */
    public function testColumnsFromTheDatabaseAreReturned(): void
    {
        $middleware = new EloquentMiddleware(new NullCache());
        $propertyMap = new PropertyMap();
        $mapper = $this->createMock(JsonMapperInterface::class);

        $middleware->handle(new \stdClass(), new ObjectWrapper(new EloquentModel()), $propertyMap, $mapper);

        self::assertTrue($propertyMap->hasProperty('id'));
    }
}
