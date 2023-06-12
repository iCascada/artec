<?php

namespace App\Events;

use App\Models\Ticket;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AfterPayed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        private Ticket $ticket,
        private int $ticketCost,
        private int $iterations,
    )
    {}

    /**
     * @return Ticket
     */
    public function getTicket(): Ticket
    {
        return $this->ticket;
    }

    /**
     * @return int
     */
    public function getTicketCost(): int
    {
        return $this->ticketCost;
    }

    /**
     * @return int
     */
    public function getIterations(): int
    {
        return $this->iterations;
    }
}
