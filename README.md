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
- [Socialite Provider](#socialite-provider)
    - [Saving the tokens](#saving-the-tokens)

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
TRUCKSPACE_BASE_URL=
TRUCKSPACE_CLIENT_ID=
TRUCKSPACE_CLIENT_SECRET=
TRUCKSPACE_REDIRECT_URI=
```

You can now use the Truckspace socialite driver like any other driver:

```php
Socialite::driver('truckspace');
```

## Testing

``` bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
