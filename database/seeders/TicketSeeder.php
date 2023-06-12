<?php

namespace Database\Seeders;

use App\Models\Code;
use App\Models\Link;
use App\Models\Report;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ticket::factory(50)
            ->create()
            ->each(function (Ticket $ticket) {
                $ticket->users()->attach(
                    User::factory()->create(),
                    [
                        'cost' => fake()->numberBetween(100, 1000),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );

                $ticket->reports()->attach(
                    Report::factory(fake()->numberBetween(3, 8))->create(),
                    [
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );

                if ($ticket->type->name === Ticket::TYPE_OFFLINE) {
                    Code::factory()->state(['ticket_id' => $ticket->id])->create();
                } else {
                    link::factory()->state(['ticket_id' => $ticket->id])->create();
                }
            });
    }
}
