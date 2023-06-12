<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\TicketType;
use Illuminate\Database\Seeder;

class TicketTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $isNotEmpty = Ticket::all()->isNotEmpty();

        if ($isNotEmpty) {
            return;
        }

        TicketType::insert([
            ['name' => 'online', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'offline', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
