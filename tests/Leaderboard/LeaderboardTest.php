<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use PHPUnit\Framework\TestCase;
use RacingCar\Leaderboard\Driver;
use RacingCar\Leaderboard\Leaderboard;
use RacingCar\Leaderboard\Race;
use RacingCar\Leaderboard\SelfDrivingCar;

class LeaderboardTest extends TestCase
{
    private Driver $driver1;
    private Driver $driver2;
    private Driver $driver3;
    private SelfDrivingCar $driver4;
    private Race $race1;
    private Race $race2;
    private Race $race3;
    private Race $race4;
    private Race $race5;
    private Race $race6;
    private Leaderboard $sampleLeaderboard1;
    private Leaderboard $sampleLeaderboard2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->driver1 = new Driver('Nico Rosberg', 'DE');
        $this->driver2 = new Driver('Lewis Hamilton', 'UK');
        $this->driver3 = new Driver('Sebastian Vettel', 'DE');
        $this->driver4 = new SelfDrivingCar('1.2', 'Acme');

        $this->race1 = new Race('Australian Grand Prix', [$this->driver1, $this->driver2, $this->driver3]);
        $this->race2 = new Race('Malaysian Grand Prix', [$this->driver3, $this->driver2, $this->driver1]);
        $this->race3 = new Race('Chinese Grand Prix', [$this->driver2, $this->driver1, $this->driver3]);
        $this->race4 = new Race('Fictional Grand Prix', [$this->driver1, $this->driver2, $this->driver4]);
        $this->race5 = new Race('Fictional Grand Prix', [$this->driver4, $this->driver2, $this->driver1]);
        $this->driver4->algorithmVersion = '1.4';
        $this->race6 = new Race('Fictional Grand Prix', [$this->driver2, $this->driver1, $this->driver4]);

        $this->sampleLeaderboard1 = new Leaderboard([$this->race1, $this->race2, $this->race3]);
        $this->sampleLeaderboard2 = new Leaderboard([$this->race4, $this->race5, $this->race6]);
    }

    public function testShouldSumThePoints(): void
    {
        $results = $this->sampleLeaderboard1->getDriverResults();

        $this->assertArrayHasKey('Lewis Hamilton', $results);
        $this->assertSame(18 + 18 + 25, $results['Lewis Hamilton']);
    }

    public function testShouldFindWinner(): void
    {
        $result = $this->sampleLeaderboard1->getDriverRankings();

        $this->assertSame('Lewis Hamilton', $result[0]);
    }

    public function testShouldKeepAllDriversWhenSamePoints(): void
    {
        $winner1 = new Race('Australian Grand Prix', [$this->driver1, $this->driver2, $this->driver3]);
        $winner2 = new Race('Malaysian Grand Prix', [$this->driver2, $this->driver1, $this->driver3]);
        $exEquoLeaderboard = new Leaderboard([$winner1, $winner2]);

        $rankings = $exEquoLeaderboard->getDriverRankings();

        $expectedRankings = [$this->driver1->name, $this->driver2->name, $this->driver3->name];
        sort($rankings); // Ensure order does not affect the result
        sort($expectedRankings);
        $this->assertSame($expectedRankings, $rankings);
    }

    public function testShouldHandleSelfDrivingCars(): void
    {
        $results = $this->sampleLeaderboard2->getDriverResults();
        $rankings = $this->sampleLeaderboard2->getDriverRankings();

        $expectedSelfDrivingCarName = 'Self Driving Car - Acme (1.4)';
        $this->assertArrayHasKey($expectedSelfDrivingCarName, $results);
        $this->assertSame(25 + 25 + 15, $results[$expectedSelfDrivingCarName]);
        $this->assertContains($expectedSelfDrivingCarName, $rankings);
    }
}
