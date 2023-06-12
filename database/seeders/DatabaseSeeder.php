<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PersonSeeder::class,
            TicketTypeSeeder::class,
            TicketSeeder::class,
            PriceSeeder::class,
        ]);
    }
}
