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
    protected static $fake = false;

    /**
     * Generate the URL for the path and base URL.
     *
     * @param  string  $path
     * @return string
     */
    public static function url(string $path): string
    {
        return 'https://id.truckspace.group/' . $path;
    }

    /**
     * Get the logged in users Truckspace details.
     *
     * @param  Model|null  $model
     * @return User|null
     */
    public static function user(?Model $model = null): ?User
    {
        if (self::$fake) {
            return (new User(null, self::$fake));
        }

        if (! $model && Auth::check()) {
            $model = Auth::user();
        }

        if (! $model && ! Auth::check()) {
            return null;
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
        self::$fake = true;
    }
}
