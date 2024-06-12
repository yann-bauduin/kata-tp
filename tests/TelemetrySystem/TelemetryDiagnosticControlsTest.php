<?php

declare(strict_types=1);

namespace Tests\TelemetrySystem;

use PHPUnit\Framework\TestCase;
use RacingCar\TelemetrySystem\TelemetryClient;
use RacingCar\TelemetrySystem\TelemetryDiagnosticControls;

class TelemetryDiagnosticControlsTest extends TestCase
{
    public function testCheckTransmissionShouldSendAndReceiveDiagnosticMessage(): void
    {
        $telemetryClientMock = $this->createMock(TelemetryClient::class);
        $telemetryClientMock->method('getOnlineStatus')
            ->will($this->onConsecutiveCalls(false, false, true));

        $telemetryClientMock->expects($this->exactly(3))
            ->method('connect')
            ->with(TelemetryDiagnosticControls::DIAGNOSTIC_CHANNEL_CONNECTION_STRING);

        $telemetryClientMock->expects($this->once())
            ->method('send')
            ->with(TelemetryClient::DIAGNOSTIC_MESSAGE);

        $telemetryClientMock->method('receive')
            ->willReturn("DIAGNOSTIC_RESPONSE");
        $controls = new TelemetryDiagnosticControls();

        $reflection = new \ReflectionClass($controls);
        $property = $reflection->getProperty('telemetryClient');
        $property->setAccessible(true);
        $property->setValue($controls, $telemetryClientMock);
        $controls->checkTransmission();
        $this->assertEquals("DIAGNOSTIC_RESPONSE", $controls->diagnosticInfo);
    }

    public function testCheckTransmissionRetriesThreeTimesBeforeFailing(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Unable to connect.');

        $telemetryClientMock = $this->createMock(TelemetryClient::class);
        $telemetryClientMock->method('getOnlineStatus')
            ->willReturn(false);

        $telemetryClientMock->expects($this->exactly(3))
            ->method('connect')
            ->with(TelemetryDiagnosticControls::DIAGNOSTIC_CHANNEL_CONNECTION_STRING);

        $controls = new TelemetryDiagnosticControls();
        $reflection = new \ReflectionClass($controls);
        $property = $reflection->getProperty('telemetryClient');
        $property->setAccessible(true);
        $property->setValue($controls, $telemetryClientMock);

        $controls->checkTransmission();
    }
}
