<?php

namespace Database\Seeders;

use App\Models\Person;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Person::factory(50)
            ->has(Reservation::factory()->count(5))
            ->create();
    }
}
