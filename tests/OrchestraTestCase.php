<?php

namespace Truckspace\Walkway\Tests;

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
        $app['config']->set('services.truckspace', [
            'client_id' => 'truckspce-client-id',
            'client_secret' => 'truckspace-client-secret',
            'redirect' => 'http://your-callback-url',
        ]);

        $app->singleton(SocialiteFactory::class, function ($app) {
            return new SocialiteManager($app);
        });
    }
}
