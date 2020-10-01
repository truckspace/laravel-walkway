<?php

namespace Truckspace\Walkway\Concerns;

use Truckspace\Walkway\Walkway;

trait HasTruckspaceAttributes
{
    /**
     * Get the users username.
     *
     * @return string|null
     */
    public function getUsernameAttribute()
    {
        return Walkway::user()->getUsername();
    }

    /**
     * Get the users profile photo.
     *
     * @return string|null
     */
    public function getProfilePhotoAttribute()
    {
        return Walkway::user()->getProfilePhoto();
    }

    /**
     * Get the users cover photo.
     *
     * @return string|null
     */
    public function getCoverPhotoAttribute()
    {
        return Walkway::user()->getCoverPhoto();
    }

    /**
     * Get the users Steam ID.
     *
     * @return int|null
     */
    public function getSteamIdAttribute()
    {
        return Walkway::user()->getSteamId();
    }

    /**
     * Get the users Discord ID.
     *
     * @return int|null
     */
    public function getDiscordIdAttribute()
    {
        return Walkway::user()->getDiscordId();
    }
}
