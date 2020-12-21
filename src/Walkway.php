<?php

namespace Truckspace\Walkway;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Truckspace\Walkway\Models\User;
use Truckspace\Walkway\Services\TruckspaceService;

class Walkway
{
    /**
     * Determines if we should fake the response.
     *
     * @var bool
     */
    protected static $shouldFake = false;

    /**
     * Generate the URL for the path and base URL.
     *
     * @param  string  $path
     * @return string
     */
    public static function url(string $path): string
    {
        if (substr($path, 0) != '/') {
            $path = '/' . $path;
        }
        return config('services.truckspace.base_url', 'https://id.truckspace.group') . $path;
    }

    /**
     * Get the logged in users Truckspace details.
     *
     * @param  Model|null  $model
     * @return User|null
     */
    public static function user(?Model $model = null): ?User
    {
        if (! $model && ! Auth::check()) {
            return null;
        }

        if (! $model && Auth::check()) {
            $model = Auth::user();
        }

        if (self::$shouldFake && $model->getAttribute(config('laravel-walkway.columns.id'))) {
            return (new User(null, self::$shouldFake));
        }

        $user = TruckspaceService::getUser($model);

        return (new User($user));
    }

    /**
     * Set the fake property to true.
     *
     * @return void
     */
    public static function fake()
    {
        self::$shouldFake = true;
    }
}
