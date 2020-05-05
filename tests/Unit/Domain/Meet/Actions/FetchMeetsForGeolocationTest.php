<?php

namespace Tests\Unit\Domain\Meet\Actions;

use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Domain\Meet\Actions\FetchMeetsForGeolocation;
use Domain\Meet\Actions\UpdateMeetAction;
use Domain\Meet\Models\Meet;
use Illuminate\Support\Carbon;
use Mockery;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domain\Meet\Actions\FetchMeetsForGeolocation
 */
class FetchMeetsForGeolocationTest extends TestCase
{
    /**
     * @var \Domain\Meet\Actions\UpdateMeetAction|\Mockery\LegacyMockInterface|\Mockery\MockInterface
     */
    private $mock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mock = Mockery::mock(UpdateMeetAction::class);
    }

    /**
     * @test
     * @covers ::execute
     */
    public function meetsAreEmptyWhenGeolocationIsAlone()
    {
        $geolocation = factory(Geolocation::class)->create();

        $meets = app(FetchMeetsForGeolocation::class)->execute($geolocation);

        $this->assertEmpty($meets);
    }

    /**
     * @test
     * @covers ::execute
     */
    public function meetIsRetrieved()
    {
        Carbon::setTestNow(now());

        $geolocation = factory(Geolocation::class)->create(
            ['location' => new Point(49.172627687418, -0.37168979644775)]
        );

        $meet = factory(Meet::class)->create([
            'geolocation_from' => $geolocation->uuid,
            'geolocation_to' => factory(Geolocation::class)->create(
                ['location' => new Point(49.172701337742, -0.37175953388214)]
            ),
            'updated_at' => now()->subSeconds(35),
        ]);

        $this->mock->shouldReceive('execute')
            ->withArgs(static function (string $from, string $to) use ($geolocation, $meet) {
                return $from === $geolocation->uuid && $to === $meet->geolocation_to;
            })
            ->once();
        app()->bind(UpdateMeetAction::class, fn () => $this->mock);

        $meets = app(FetchMeetsForGeolocation::class)->execute($geolocation);

        $this->assertEquals([$meet->geolocation_to], $meets->pluck('geolocation_to')->all());
    }

    /**
     * @test
     * @covers ::execute
     */
    public function resultsIsEmptyWhenGeolocationsAreFar()
    {
        Carbon::setTestNow(now());

        $geolocation = factory(Geolocation::class)->create(
            ['location' => new Point(49.172515458143, -0.37145912647247)]
        );

        factory(Meet::class)->create([
            'geolocation_from' => $geolocation->uuid,
            'geolocation_to' => factory(Geolocation::class)->create(
                ['location' => new Point(49.172701337742, -0.37175953388214)]
            ),
            'updated_at' => now()->subMinute(),
        ]);

        $meets = app(FetchMeetsForGeolocation::class)->execute($geolocation);

        $this->assertEmpty($meets);
    }

    /**
     * @test
     * @covers ::execute
     */
    public function resultsIsEmptyWhenMeetAreMoreThanXSeconds()
    {
        Carbon::setTestNow(now());

        $geolocation = factory(Geolocation::class)->create(
            ['location' => new Point(49.172627687418, -0.37168979644775)]
        );

        $meet = factory(Meet::class)->create([
            'geolocation_from' => $geolocation->uuid,
            'geolocation_to' => factory(Geolocation::class)->create(
                ['location' => new Point(49.172701337742, -0.37175953388214)]
            ),
            'updated_at' => now()->subSeconds(20),
        ]);

        $this->mock->shouldReceive('execute')
            ->withArgs(static function (string $from, string $to) use ($geolocation, $meet) {
                return $from === $geolocation->uuid && $to === $meet->geolocation_to;
            })
            ->once();
        app()->bind(UpdateMeetAction::class, fn () => $this->mock);

        $meets = app(FetchMeetsForGeolocation::class)->execute($geolocation);

        $this->assertEmpty($meets);
    }

    /**
     * @test
     * @covers ::execute
     */
    public function resultsIsEmptyWhenMeetExistsButGeolocationIsOlder()
    {
        Carbon::setTestNow(now());

        $geolocation = factory(Geolocation::class)->create(
            ['location' => new Point(49.172627687418, -0.37168979644775)]
        );

        factory(Geolocation::class)->create(
            [
                'location' => new Point(49.172701337742, -0.37175953388214),
                'updated_at' => now()->subDay(),
            ]
        );

        $meets = app(FetchMeetsForGeolocation::class)->execute($geolocation);

        $this->assertEmpty($meets);
    }
}
