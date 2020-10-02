<?php

namespace Truckspace\Walkway\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Truckspace\Walkway\Walkway;

class TruckspaceService
{
    /**
     * Get the Truckspace user from the cache or API.
     *
     * @return array|null
     */
    public static function getUser(): ?array
    {
        $store = config('laravel-walkway.cache.store');

        if (! $store) {
            $store = config('cache.default');
        }

        $truckspaceId = Auth::user()->getAttribute(config('laravel-walkway.columns.id'));

        if (! $truckspaceId) {
            return null;
        }

        $key = config('laravel-walkway.cache.prefix') . $truckspaceId;

        return Cache::store($store)->remember($key, config('laravel-walkway.cache.ttl'), function () {
            return self::getUserFromApi();
        });
    }

    /**
     * Get the Truckspace user from the API.
     *
     * @return array|null
     */
    protected static function getUserFromApi(): ?array
    {
        $accessToken = self::getAccessToken();

        $response = Http::withToken($accessToken)
            ->get(Walkway::url('api/me'))
            ->onError(static function ($response) {
                Log::error('Failed to get Truckspace user', [
                    'body' => $response->getBody(),
                    'user' => Auth::user(),
                ]);

                return null;
            });

        if (! $response || ! $response->json()) {
            return null;
        }

        return $response->json();
    }

    /**
     * Get the users access token.
     *
     * @return string|null
     */
    protected static function getAccessToken(): ?string
    {
        $tokens = Auth::user()->getAttribute(config('laravel-walkway.columns.tokens'));

        if (config('laravel-walkway.columns.encrypt')) {
            $tokens = json_decode(decrypt($tokens));
        } else {
            $tokens = json_decode($tokens);
        }

        if (Carbon::now() > $tokens->expires_at) {
            return self::refreshTokens($tokens->refresh_token);
        }

        return $tokens->access_token;
    }

    /**
     * Refresh thte users tokens.
     *
     * @param  string  $refreshToken
     * @return string|null
     */
    protected static function refreshTokens(string $refreshToken): ?string
    {
        $response = Http::asForm()->post(Walkway::url('oauth/token'), [
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
            'client_id' => config('services.truckspace.client_id'),
            'client_secret' => config('services.truckspace.client_secret'),
            'scope' => '',
        ])->onError(static function ($response) {
            Log::error('Failed to refresh Truckspace tokens', [
                'body' => $response->getBody(),
                'user' => Auth::user(),
            ]);

            return null;
        });

        if (! $response) {
            return null;
        }

        $tokens = json_encode([
            'access_token' => $response->json()['access_token'],
            'refresh_token' => $response->json()['refresh_token'],
            'expires_at' => Carbon::now()->addSeconds($response->json()['expires_in']),
        ]);

        if (config('laravel-walkway.columns.encrypt')) {
            $tokens = encrypt($tokens);
        }

        $user = Auth::user();

        $user->setAttribute(config('laravel-walkway.columns.tokens'), $tokens);
        $user->save();

        return $response->json()['access_token'];
    }
}
