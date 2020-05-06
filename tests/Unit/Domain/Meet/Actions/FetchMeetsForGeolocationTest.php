<?php

namespace Tests\Unit\Domain\Meet\Actions;

use Domain\Geolocation\Models\Geolocation;
use Domain\Geolocation\Models\Point;
use Domain\Meet\Actions\CleanOlderMeetsAction;
use Domain\Meet\Actions\CreateMeetAction;
use Domain\Meet\Actions\FetchMeetsForGeolocation;
use Domain\Meet\Actions\UpdateMeetAction;
use Domain\Meet\Models\Meet;
use Illuminate\Support\Carbon;
use Tests\TestCase;

/**
 * @coversDefaultClass \Domain\Meet\Actions\FetchMeetsForGeolocation
 */
class FetchMeetsForGeolocationTest extends TestCase
{
    /**
     * @var \Domain\Meet\Actions\CreateMeetAction|\Mockery\LegacyMockInterface|\Mockery\MockInterface
     */
    private $createMeetMock;

    /**
     * @var \Domain\Meet\Actions\UpdateMeetAction|\Mockery\LegacyMockInterface|\Mockery\MockInterface
     */
    private $updateMeetMock;

    /**
     * @var \Domain\Meet\Actions\UpdateMeetAction|\Mockery\LegacyMockInterface|\Mockery\MockInterface
     */
    private $cleanOlderMeetsMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->createMeetMock = $this->mock(CreateMeetAction::class);
        $this->updateMeetMock = $this->mock(UpdateMeetAction::class);
        $this->cleanOlderMeetsMock = $this->mock(CleanOlderMeetsAction::class);

        $this->createMeetMock->shouldNotReceive('execute');
        $this->updateMeetMock->shouldNotReceive('execute');
    }

    /**
     * @test
     * @covers ::execute
     */
    public function nothingIsReturnedWhenGeolocationIsAlone()
    {
        $geolocation = factory(Geolocation::class)->create();

        $this->cleanOlderMeetsMock->shouldReceive('execute')
            ->withArgs([$geolocation, []])
            ->once();

        $meets = app(FetchMeetsForGeolocation::class)->execute($geolocation);

        $this->assertEmpty($meets);
    }

    /**
     * @test
     * @covers ::execute
     */
    public function nothingIsReturnedWhenGeolocationsAreSoFar()
    {
        $geolocation = factory(Geolocation::class)->create(
            ['location' => new Point(49.172515458143, -0.37145912647247)]
        );

        factory(Geolocation::class)->create(
            ['location' => new Point(49.172701337742, -0.37175953388214)]
        );

        $this->cleanOlderMeetsMock->shouldReceive('execute')
            ->withArgs([$geolocation, []])
            ->once();

        $meets = app(FetchMeetsForGeolocation::class)->execute($geolocation);

        $this->assertEmpty($meets);
    }

    /**
     * @test
     * @covers ::execute
     */
    public function nothingIsReturnedWhenGeolocationsOlderThanATime()
    {
        $geolocation = factory(Geolocation::class)->create(
            ['location' => new Point(49.172627687418, -0.37168979644775)]
        );

        $otherGeolocation = factory(Geolocation::class)->create(
            ['location' => new Point(49.172701337742, -0.37175953388214)]
        );

        $this->cleanOlderMeetsMock->shouldReceive('execute')
            ->withArgs([$geolocation, [$otherGeolocation->uuid]])
            ->once();

        $this->createMeetMock->shouldReceive('execute')
            ->withArgs(static function (Geolocation $currentGeolocation, string $otherGeolocationUUid) use (
                $otherGeolocation,
                $geolocation
            ) {
                return $geolocation->uuid === $currentGeolocation->uuid && $otherGeolocationUUid === $otherGeolocation->uuid;
            })
            ->once();

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

        $this->updateMeetMock->shouldReceive('execute')
            ->withArgs(static function (Meet $currentMeet) use ($meet): bool {
                return $currentMeet->is($meet);
            })
            ->once();

        $this->cleanOlderMeetsMock->shouldReceive('execute')
            ->withArgs([$geolocation, [$meet->geolocation_to]])
            ->once();

        $meets = app(FetchMeetsForGeolocation::class)->execute($geolocation);

        $this->assertEquals([$meet->geolocation_to], $meets->pluck('geolocation_to')->all());
    }

    /**
     * @test
     * @covers ::execute
     */
    public function nothingIsReturnedWhenMeetExistsButGeolocationIsOlder()
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

        $this->cleanOlderMeetsMock->shouldReceive('execute')
            ->withArgs([$geolocation, [$meet->geolocation_to]])
            ->once();

        $meets = app(FetchMeetsForGeolocation::class)->execute($geolocation);

        $this->assertEmpty($meets);
    }
}
