<?php

namespace Truckspace\Walkway\Tests;

use Illuminate\Foundation\Testing\WithFaker;
use Truckspace\Walkway\Models\User;

class UserModelTest extends OrchestraTestCase
{
    use WithFaker;

    /**
     * The users data to test against.
     *
     * @var array
     */
    protected $userData;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->userData = [
            'id' => $this->faker->numberBetween(),
            'username' => $this->faker->userName,
            'profile_photo' => $this->faker->imageUrl(),
            'cover_photo' => $this->faker->imageUrl(),
            'steam_id' => $this->faker->numberBetween(),
            'discord_id' => $this->faker->numberBetween(),
        ];
    }

    public function test_it_can_get_the_users_id()
    {
        $user = new User($this->userData);

        $this->assertIsInt($user->getId());
        $this->assertSame($this->userData['id'], $user->getId());
    }

    public function test_it_can_get_the_users_username()
    {
        $user = new User($this->userData);

        $this->assertIsString($user->getUsername());
        $this->assertSame($this->userData['username'], $user->getUsername());
    }

    public function test_it_can_get_the_users_profile_photo()
    {
        $user = new User($this->userData);

        $this->assertIsString($user->getProfilePhoto());
        $this->assertSame($this->userData['profile_photo'], $user->getProfilePhoto());
    }

    public function test_it_can_get_the_users_cover_photo()
    {
        $user = new User($this->userData);

        $this->assertIsString($user->getCoverPhoto());
        $this->assertSame($this->userData['cover_photo'], $user->getCoverPhoto());
    }

    public function test_it_can_get_the_users_steam_id()
    {
        $user = new User($this->userData);

        $this->assertIsInt($user->getSteamId());
        $this->assertSame($this->userData['steam_id'], $user->getSteamId());
    }

    public function test_it_can_get_the_users_discord_id()
    {
        $user = new User($this->userData);

        $this->assertIsInt($user->getDiscordId());
        $this->assertSame($this->userData['discord_id'], $user->getDiscordId());
    }

    public function test_it_can_fake_a_user()
    {
        $user = new User(null, true);

        $this->assertIsInt($user->getId());
        $this->assertIsString($user->getUsername());
        $this->assertIsString($user->getProfilePhoto());
        $this->assertIsString($user->getCoverPhoto());
        $this->assertIsInt($user->getSteamId());
        $this->assertIsInt($user->getDiscordId());
    }
}
