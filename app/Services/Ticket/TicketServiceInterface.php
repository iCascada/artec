<?php

declare(strict_types=1);

namespace App\Services\Ticket;

interface TicketServiceInterface
{
    public function getCost(): int;
    public function pay(): void;
}