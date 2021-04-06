<?php

namespace Truckspace\Walkway;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\Contracts\Factory;
use Truckspace\Walkway\SocialiteProviders\TruckspaceProvider;

class WalkwayServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/walkway.php', 'walkway');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     *
     * @throws BindingResolutionException
     */
    public function boot(): void
    {
        $this->registerPublishing();
        $this->configureSocialiteProvider();
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../config/walkway.php' => config_path('walkway.php'),
        ], 'walkway-config');
    }

    /**
     * Configure the Truckspace Socialite provider.
     *
     * @return void
     *
     * @throws BindingResolutionException
     */
    protected function configureSocialiteProvider(): void
    {
        $socialite = $this->app->make(Factory::class);

        $socialite->extend('truckspace', function ($app) use ($socialite) {
            $config = $app['config']['services.truckspace'];

            return $socialite->buildProvider(TruckspaceProvider::class, $config);
        });
    }
}
