<?php

namespace Truckspace\Walkway\Models;

class User
{
    /**
     * The users ID.
     *
     * @var int|null
     */
    protected $id;

    /**
     * The users username.
     *
     * @var string|null
     */
    protected $username;

    /**
     * @var string|null
     */
    protected $profilePhoto;

    /**
     * @var string|null
     */
    protected $coverPhoto;

    /**
     * Get the users Steam ID.
     *
     * @var int|null
     */
    protected $steamId;

    /**
     * Get the users Discord ID.
     *
     * @var int|null
     */
    protected $discordId;

    /**
     * Create a new User instance.
     *
     * @param  array  $user
     * @return void
     */
    public function __construct($user)
    {
        if ($user) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->profilePhoto = $user['profile_photo'];
            $this->coverPhoto = $user['cover_photo'];
            $this->steamId = $user['steam_id'];
            $this->discordId = $user['discord_id'];
        }
    }

    /**
     * Get the users ID.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the users username.
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Get the users profile photo.
     *
     * @return string|null
     */
    public function getProfilePhoto()
    {
        return $this->profilePhoto;
    }

    /**
     * Get the users cover photo.
     *
     * @return string|null
     */
    public function getCoverPhoto()
    {
        return $this->coverPhoto;
    }

    /**
     * Get the users Steam ID.
     *
     * @return int|mixed
     */
    public function getSteamId()
    {
        return $this->steamId;
    }

    /**
     * Get the users Discord ID.
     *
     * @return int|mixed
     */
    public function getDiscordId()
    {
        return $this->discordId;
    }
}
