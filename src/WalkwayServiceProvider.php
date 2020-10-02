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
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-walkway.php', 'laravel-walkway');
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
        $this->configurePublishing();
        $this->configureSocialiteProvider();
    }

    /**
     * Configure the publishable resources offered by the package.
     *
     * @return void
     */
    protected function configurePublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/laravel-walkway.php' => config_path('laravel-walkway.php'),
            ], 'walkway-config');

            $migrationFileName = 'create_walkway_columns.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $path =  database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName);

                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => $path,
                ], 'walkway-migrations');
            }
        }
    }

    /**
     * Check if the specified migration file already exists.
     *
     * @param  string  $migrationFileName
     * @return bool
     */
    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
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
