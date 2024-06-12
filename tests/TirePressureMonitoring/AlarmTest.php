<?php

declare(strict_types=1);

namespace Tests\TirePressureMonitoring;

use PHPUnit\Framework\TestCase;
use RacingCar\TirePressureMonitoring\Alarm;
use RacingCar\TirePressureMonitoring\FakeSensor;

class AlarmTest extends TestCase
{
    public function testAlarmIsOffByDefault(): void
    {
        $alarm = new Alarm(new FakeSensor(19));
        $this->assertFalse($alarm->isAlarmOn());
    }

    public function testAlarmGoesOnWhenPressureIsTooLow(): void
    {
        $alarm = new Alarm(new FakeSensor(16));
        $alarm->check();
        $this->assertTrue($alarm->isAlarmOn());
    }

    public function testAlarmGoesOnWhenPressureIsTooHigh(): void
    {
        $alarm = new Alarm(new FakeSensor(22));
        $alarm->check();
        $this->assertTrue($alarm->isAlarmOn());
    }

    public function testAlarmStaysOffWhenPressureIsNormal(): void
    {
        $alarm = new Alarm(new FakeSensor(18));
        $alarm->check();
        $this->assertFalse($alarm->isAlarmOn());
    }
}
