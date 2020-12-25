<?php

namespace Truckspace\Walkway\Models;

use Faker\Factory;

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
     * @param  array|null  $user
     * @param  bool  $fake
     * @return void
     */
    public function __construct(?array $user, bool $fake = false)
    {
        if ($fake) {
            $faker = Factory::create();

            $this->id = $faker->randomNumber();
            $this->username = $faker->userName;
            $this->profilePhoto = $faker->imageUrl();
            $this->coverPhoto = $faker->imageUrl();
            $this->steamId = '765' . $faker->randomNumber(7, true) . $faker->randomNumber(7, true);
            $this->discordId = $faker->randomNumber();
        } elseif ($user) {
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
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the users username.
     *
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Get the users profile photo.
     *
     * @return string|null
     */
    public function getProfilePhoto(): ?string
    {
        return $this->profilePhoto;
    }

    /**
     * Get the users cover photo.
     *
     * @return string|null
     */
    public function getCoverPhoto(): ?string
    {
        return $this->coverPhoto;
    }

    /**
     * Get the users Steam ID.
     *
     * @return int|mixed
     */
    public function getSteamId(): ?int
    {
        return $this->steamId;
    }

    /**
     * Get the users Discord ID.
     *
     * @return int|mixed
     */
    public function getDiscordId(): ?int
    {
        return $this->discordId;
    }
}
