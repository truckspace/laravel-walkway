<p align="center"><img src="https://raw.githubusercontent.com/truckspace/art/68646a1f845c6f9a8c18574fe28cdcc73b0a8515/laravel-walkway/logo.svg"></p>

<p align="center">
    <a href="https://github.com/truckspace/laravel-walkway/actions">
        <img src="https://github.com/truckspace/laravel-walkway/workflows/Tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/truckspace/laravel-walkway">
        <img src="https://poser.pugx.org/truckspace/laravel-walkway/d/total.svg" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/truckspace/laravel-walkway">
        <img src="https://poser.pugx.org/truckspace/laravel-walkway/v/stable.svg" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/truckspace/laravel-walkway">
        <img src="https://poser.pugx.org/truckspace/laravel-walkway/license.svg" alt="License">
    </a>
</p>

## Introduction

Laravel Walkway aims to provide a simple and intuitive interface for authenticating with the [Truckspace ID](https://id.truckspace.group) OAuth server.

## Using Laravel Walkway

- [Installation](#installation)
    - [Configuration](#configuration)
- [Socialite Provider](#socialite-provider)
    - [Saving the tokens](#saving-the-tokens)
- [Retrieve the Current User](#retrieve-the-current-user)
    - [Model Attributes](#model-attributes)

<a name="installation"></a>
### Installation

To get started, install Walkway using Composer:

```bash
composer require truckspace/laravel-walkway
```

Next, publish Walkways's resources:

```bash
php artisan vendor:publish --provider="Truckspace\Walkway\WalkwayServiceProvider"
```

This command will publish Walkways's config file and default migrations.

Next, you should migrate your database:

```bash
php artisan migrate
```

<a name="configuration"></a>
#### Configuration

The config file allows you to customize the behaviour of Walkway to suite your application.

**Columns**

 By default, Walkway publishes a migration file which contains a field to store the users Truckspace ID and a tokens field. The tokens field is used to store the users access token, refresh token and the date the access token expries (7 days after issue).

If you change the names of the columns in the default migration, you will need to update the id and tokens config value to match the column names.

Walkway also supports encrypting the content of the tokens field. This can be changed by setting the `encrypt` value to either `true` or `false`.

```php
'columns' => [

    // The name of the column used to store the users Truckspace ID
    'id' => 'truckspace_id',

    // The name of the column used to store the users tokens
    'tokens' => 'truckspace_tokens',

    // Determines if the contents of the tokens field is encrypted
    'encrypt' => true,

],
```

**Cache** 

One advantage of using Walkway, is that it will automatically take care of caching the data for each user. We provide a few configuration options to change the behaviour of the cache.

```php
'cache' => [

    // The name of the cache store (this will use the default cache out of the box)
    'store' => null,

    // The prefix for the cache key followed by the users ID
    'prefix' => 'truckspace-user:',

    // The ttl (in seconds) of how long the data should be cached
    'ttl' => 1800,

],
```

<a name="socialite-provider"></a>
### Socialite Provider

[Laravel Socialite](https://laravel.com/docs/master/socialite) provides a simple way to authenticate with OAuth providers. Walkway provides a Truckspace driver to make authentication as easy as possible.

To use the Truckspace socialite driver, you will need to create an application on the [Truckspace ID developers](https://id.truckspace.group/developers) page. These credentails should then be placed in your `config/services.php` configuration file:

```php
'truckspace' => [
    'client_id' => env('TRUCKSPACE_CLIENT_ID'),
    'client_secret' => env('TRUCKSPACE_CLIENT_SECRET'),
    'redirect' => env('TRUCKSPACE_REDIRECT_URI'),
],
```

Finally, add the following environment varables:

```
# Truckspace OAuth
TRUCKSPACE_CLIENT_ID=
TRUCKSPACE_CLIENT_SECRET=
TRUCKSPACE_REDIRECT_URI=
```

You can now use the Truckspace socialite driver like any other driver:

```
Socialite::driver('truckspace');
```

<a name="saving-the-tokens"></a>
#### Saving the tokens

When saving the tokens from socialite, you will need to build an array with the following keys and then store the json encoded value in the database field:

```php
$socialiteUser = Socialite::driver('truckspace')->user();

$tokens = [
    'access_token' => $socialiteUser->token,
    'refresh_token' => $socialiteUser->refreshToken,
    'expires_at' => Carbon::now()->addSeconds($socialiteUser->expiresIn),
];

$user = new User();

$user->truckspace_id = $socialiteUser->getId();
$user->truckspace_tokens = json_encode($tokens);

$user->save();
```

> Note: if you have encryption enabled, you will need to encrypt the json encoded data first. This can be done by using Laravel's `encrypt` helper method. For more information on how Laravel handles encryption, you can visit the [Encryption](https://laravel.com/docs/master/encryption) page.

<a name="retrieve-the-current-user"></a>
### Retrieve the Current User

Now that you have authenticated the user, you can retrieve the users Truckspace details by using the following methods:

```php
Walkway::user()->getId();
Walkway::user()->getUsername();
Walkway::user()->getProfilePhoto();
Walkway::user()->getCoverPhoto();
Walkway::user()->getSteamId();
Walkway::user()->getDiscordId();
```

<a name="model-attributes"></a>
#### Model Attributes

Walkway also provides a way to automatically add the corresponding attributes to your user model. This means that you can directly get the users Truckspace username, steam ID etc from your user instance.

First, you will need to add the `HasTruckspaceAttributes` trait to your user model:

```php
<?php

namespace App\Models;

use Truckspace\Walkway\Concerns\HasTruckspaceAttributes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasTruckspaceAttributes;
}
```

Now, you will be able to call an attribute like so:

```php
$user = User::first();

// Same as Walkway::user()->getUsername();
$name = $user->username;

// Same as Walkway::user()->getProfilePhoto();
$profilePhoto = $user->profile_photo;

// Same as Walkway::user()->getCoverPhoto();
$coverPhoto = $user->cover_photo;

// Same as Walkway::user()->getSteamId();
$steamId = $user->steam_id;

// Same as Walkway::user()->getDiscordId();
$discorId = $user->discord_id;
```

## Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
