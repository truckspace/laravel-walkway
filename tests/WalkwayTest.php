<?php

namespace Truckspace\Walkway\Tests;

use Truckspace\Walkway\Walkway;

class WalkwayTest extends OrchestraTestCase
{
    public function test_it_can_generate_a_url()
    {
        $baseUrl = config('laravel-walkway.base_url');
        $url = Walkway::url('api');

        $this->assertSame($baseUrl . '/api', $url);
    }
}
