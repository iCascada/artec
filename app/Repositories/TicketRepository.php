<?php

namespace App\Repositories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Collection;

class TicketRepository
{
    public function __construct(
        private readonly Ticket $ticket,
        private readonly UserRepository $userRepository,
    )
    {}

    public function getTicketsByIdsWithCost(array $ticketIds): Collection | null
    {
        return $this->ticket
            ->whereIn('id', $ticketIds)
            ->with('users')
            ->get();
    }

    public function getTicketByIdWithReports(int $ticketId): Ticket | null
    {
        return $this->ticket->where('id', $ticketId)->with('reports')->first();
    }

    public function attachAttributes(Ticket $ticket, int $count): void
    {
        if ($ticket->type->name === Ticket::TYPE_ONLINE) {
            do {
                $ticket->link()->create([
                    'link' => 'https://google.com/' . fake()->sha1(),
                ]);

                if ($count) {
                    $count--;
                }
            } while ($count);

            return;
        }

        do {
            $ticket->code()->create([
                'code' => fake()->imei(),
            ]);

            if ($count) {
                $count--;
            }
        } while ($count);
    }

    public function attachUser(Ticket $ticket, int $cost): void
    {
        $ticket
            ->users()
            ->attach(
                $this->userRepository->auth(),
                [
                    'cost' => $cost,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
    }
}