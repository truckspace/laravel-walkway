<?php

namespace Truckspace\Walkway;

use Illuminate\Support\Facades\Auth;
use Truckspace\Walkway\Models\User;
use Truckspace\Walkway\Services\TruckspaceService;

class Walkway
{
    /**
     * Generate the URL for the path and base URL.
     *
     * @param  string  $path
     * @return string
     */
    public static function url(string $path)
    {
        return 'https://id.truckspace.group/' . $path;
    }

    /**
     * Get the logged in users Truckspace details.
     *
     * @return User|null
     */
    public static function user()
    {
        if (! Auth::check()) {
            return null;
        }

        $user = TruckspaceService::getUser();

        return (new User($user));
    }
}
