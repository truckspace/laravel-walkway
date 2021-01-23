<?php

namespace Truckspace\Walkway\Tests;

use Laravel\Socialite\Contracts\Factory;
use Truckspace\Walkway\SocialiteProviders\TruckspaceProvider;

class TruckspaceSocialiteTest extends OrchestraTestCase
{
    public function test_it_can_instantiate_the_truckspace_driver()
    {
        $factory = $this->app->make(Factory::class);

        $provider = $factory->driver('truckspace');

        $this->assertInstanceOf(TruckspaceProvider::class, $provider);
    }
}
