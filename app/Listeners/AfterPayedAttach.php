<?php

namespace App\Listeners;

use App\Events\AfterPayed;
use App\Repositories\TicketRepository;

class AfterPayedAttach
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private TicketRepository $ticketRepository,
    )
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AfterPayed $event): void
    {
        $this->ticketRepository->attachUser(
            $event->getTicket(),
            $event->getTicketCost(),
        );

        $this->ticketRepository->attachAttributes(
            $event->getTicket(),
            $event->getIterations(),
        );
    }
}
