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
    public function getUsernameAttribute(): ?string
    {
        return Walkway::user($this)->getUsername();
    }

    /**
     * Get the users profile photo.
     *
     * @return string|null
     */
    public function getProfilePhotoAttribute(): ?string
    {
        return Walkway::user($this)->getProfilePhoto();
    }

    /**
     * Get the users cover photo.
     *
     * @return string|null
     */
    public function getCoverPhotoAttribute(): ?string
    {
        return Walkway::user($this)->getCoverPhoto();
    }

    /**
     * Get the users Steam ID.
     *
     * @return int|null
     */
    public function getSteamIdAttribute(): ?int
    {
        return Walkway::user($this)->getSteamId();
    }

    /**
     * Get the users Discord ID.
     *
     * @return int|null
     */
    public function getDiscordIdAttribute(): ?int
    {
        return Walkway::user($this)->getDiscordId();
    }
}
