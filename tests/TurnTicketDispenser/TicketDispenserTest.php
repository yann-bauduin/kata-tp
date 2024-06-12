<?php

declare(strict_types=1);

namespace Tests\TurnTicketDispenser;

use PHPUnit\Framework\TestCase;
use RacingCar\TurnTicketDispenser\TicketDispenser;

class TicketDispenserTest extends TestCase
{
    public function testSingleDispenser(): void
    {
        $dispenser = new TicketDispenser();
        $firstTicket = $dispenser->getTurnTicket();
        $secondTicket = $dispenser->getTurnTicket();

        $this->assertSame(0, $firstTicket->getTurnNumber());
        $this->assertSame(1, $secondTicket->getTurnNumber());
    }

    public function testMultipleDispensers(): void
    {
        $dispenser1 = new TicketDispenser();
        $dispenser2 = new TicketDispenser();

        $firstTicketFromDispenser1 = $dispenser1->getTurnTicket();
        $firstTicketFromDispenser2 = $dispenser2->getTurnTicket();

        $this->assertSame(2, $firstTicketFromDispenser1->getTurnNumber());
        $this->assertSame(3, $firstTicketFromDispenser2->getTurnNumber());
    }
}
