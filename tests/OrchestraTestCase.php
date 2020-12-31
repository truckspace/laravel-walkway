<?php

namespace Truckspace\Walkway\Tests;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Application;
use Laravel\Socialite\Contracts\Factory as SocialiteFactory;
use Laravel\Socialite\SocialiteManager;
use Mockery;
use Orchestra\Testbench\TestCase as Orchestra;
use Truckspace\Walkway\WalkwayServiceProvider;

abstract class OrchestraTestCase extends Orchestra
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase($this->app);
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    public function tearDown(): void
    {
        Mockery::close();
    }

    /**
     * Get package providers.
     *
     * @param  Application  $app
     * @return array
     */
    protected function getPackageProviders($app): array
    {
        return [
            WalkwayServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  Application  $app
     * @return void
     */
    public function getEnvironmentSetUp($app): void
    {
        // Setup database
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Setup socialite provider
        $app['config']->set('services.truckspace', [
            'client_id' => 'truckspce-client-id',
            'client_secret' => 'truckspace-client-secret',
            'redirect' => 'http://your-callback-url',
        ]);

        $app->singleton(SocialiteFactory::class, function ($app) {
            return new SocialiteManager($app);
        });
    }

    /**
     * Setup the database.
     *
     * @param  Application  $app
     * @return void
     */
    protected function setUpDatabase(Application $app): void
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamps();
        });

        include_once __DIR__ . '/../database/migrations/create_walkway_columns.php.stub';

        (new \CreateWalkwayColumns())->up();
    }
}
