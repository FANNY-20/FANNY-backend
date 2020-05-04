<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @coversDefaultClass \App\Providers\HorizonServiceProvider
 */
class HorizonTest extends TestCase
{
    /**
     * @test
     * @covers ::boot
     */
    public function horizonIsAccessible()
    {
        $this->getJson(
            'horizon',
            ['Authorization' => 'Bearer some-random-string']
        )->assertSuccessful();
    }

    /**
     * @test
     * @covers ::boot
     */
    public function horizonAccessIsForbidden()
    {
        $this->getJson('horizon')->assertForbidden();
    }
}
