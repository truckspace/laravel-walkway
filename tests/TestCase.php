<?php

namespace Truckspace\Walkway\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Laravel\Socialite\SocialiteManager;
use Orchestra\Testbench\TestCase as Orchestra;
use Truckspace\Walkway\WalkwayServiceProvider;
use Laravel\Socialite\Contracts\Factory as SocialiteFactory;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            WalkwayServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
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
