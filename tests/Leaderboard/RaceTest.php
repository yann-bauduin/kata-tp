<?php

declare(strict_types=1);

namespace Tests\Leaderboard;

use PHPUnit\Framework\TestCase;
use RacingCar\Leaderboard\Driver;
use RacingCar\Leaderboard\Race;
use RacingCar\Leaderboard\SelfDrivingCar;

class RaceTest extends TestCase
{
    private Driver $driver1;
    private Driver $driver2;
    private Driver $driver3;
    private SelfDrivingCar $driver4;
    private Race $race1;
    private Race $race2;

    protected function setUp(): void
    {
        parent::setUp();

        $this->driver1 = new Driver('Nico Rosberg', 'DE');
        $this->driver2 = new Driver('Lewis Hamilton', 'UK');
        $this->driver3 = new Driver('Sebastian Vettel', 'DE');
        $this->driver4 = new SelfDrivingCar('1.2', 'Acme');

        $this->race1 = new Race('Australian Grand Prix', [$this->driver1, $this->driver2, $this->driver3]);
        $this->race2 = new Race('Fictional Grand Prix', [$this->driver1, $this->driver2, $this->driver4]);
    }

    public function testShouldCalculateDriverPoints(): void
    {
        $this->assertSame(25, $this->race1->getPoints($this->driver1));
        $this->assertSame(18, $this->race1->getPoints($this->driver2));
        $this->assertSame(15, $this->race1->getPoints($this->driver3));
    }

    public function testShouldHandleSelfDrivingCarPoints(): void
    {
        $this->assertSame(25, $this->race2->getPoints($this->driver1));
        $this->assertSame(18, $this->race2->getPoints($this->driver2));
        $this->assertSame(15, $this->race2->getPoints($this->driver4));
    }

    public function testShouldReturnCorrectDriverNames(): void
    {
        $this->assertSame('Nico Rosberg', $this->race1->getDriverName($this->driver1));
        $this->assertSame('Lewis Hamilton', $this->race1->getDriverName($this->driver2));
        $this->assertSame('Sebastian Vettel', $this->race1->getDriverName($this->driver3));
        $this->assertSame('Self Driving Car - Acme (1.2)', $this->race2->getDriverName($this->driver4));
    }
}
