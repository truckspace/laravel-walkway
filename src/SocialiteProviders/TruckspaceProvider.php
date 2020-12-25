<?php

namespace Truckspace\Walkway\SocialiteProviders;

use GuzzleHttp\Exception\GuzzleException;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;
use Truckspace\Walkway\Walkway;

class TruckspaceProvider extends AbstractProvider
{
    /**
     * Get the authentication URL for the provider.
     *
     * @param  string  $state
     * @return string
     */
    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase(Walkway::url('oauth/authorize'), $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl(): string
    {
        return Walkway::url('oauth/token');
    }

    /**
     * Get the raw user for the given access token.
     *
     * @param  string  $token
     * @return array
     *
     * @throws GuzzleException
     */
    protected function getUserByToken($token): array
    {
        $response = $this->getHttpClient()->get(Walkway::url('api/me'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Map the raw user array to a Socialite User instance.
     *
     * @param  array  $user
     * @return User
     */
    protected function mapUserToObject(array $user): User
    {
        return (new User())->setRaw($user)->map([
            'id' => $user['id'],
            'nickname' => $user['username'],
            'name' => $user['username'],
            'email' => null,
            'avatar' => $user['profile_photo'],
        ]);
    }

    /**
     * Get the POST fields for the token request.
     *
     * @param  string  $code
     * @return array
     */
    protected function getTokenFields($code): array
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
