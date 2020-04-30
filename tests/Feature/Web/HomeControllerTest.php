<?php

namespace Tests\Feature\Web;

use Tests\TestCase;

/**
 * @coversDefaultClass \App\Web\Controllers\HomeController
 */
class HomeControllerTest extends TestCase
{
    /**
     * @test
     * @covers ::__invoke
     */
    public function homeDescribeApplication()
    {
        $this->get('/')
            ->assertSuccessful()
            ->assertExactJson([
                'name' => 'Stop-Covid API',
                'description' => 'Expose routes API for hybrid application',
                'website' => config('app.url'),
            ]);
    }
}
