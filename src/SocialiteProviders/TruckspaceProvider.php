<?php

namespace Truckspace\Walkway\SocialiteProviders;

use GuzzleHttp\Exception\GuzzleException;
use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\User;

class TruckspaceProvider extends AbstractProvider
{
    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = [
        'identity',
    ];

    /**
     * The separating character for the requested scopes.
     *
     * @var string
     */
    protected $scopeSeparator = ' ';

    /**
     * Get the authentication URL for the provider.
     *
     * @param  string  $state
     * @return string
     */
    protected function getAuthUrl($state): string
    {
        return $this->buildAuthUrlFromBase($this->buildUrl('oauth/authorize'), $state);
    }

    /**
     * Get the token URL for the provider.
     *
     * @return string
     */
    protected function getTokenUrl(): string
    {
        return $this->buildUrl('oauth/token');
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
        $uri = $this->buildUrl('api/me');

        $response = $this->getHttpClient()->get($uri, [
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
            'id' => $user['data']['id'],
            'nickname' => $user['data']['username'],
            'name' => $user['data']['username'],
            'email' => $user['data']['email'],
            'avatar' => $user['data']['profile_photo'],
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

    /**
     * Build the url from the specified path and base url.
     * @param  string  $path
     * @return string
     */
    protected function buildUrl(string $path): string
    {
        if (substr($path, 0) != '/') {
            $path = '/' . $path;
        }

        return config('walkway.base_url') . $path;
    }
}
