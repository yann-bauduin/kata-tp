<?php

namespace RacingCar\TirePressureMonitoring;

class FakeSensor extends Sensor
{
    private float $pressure;

    public function __construct(float $pressure)
    {
        $this->pressure = $pressure;
    }

    public function popNextPressurePsiValue(): float
    {
        return $this->pressure;
    }
}
