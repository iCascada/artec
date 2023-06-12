<?php

namespace Database\Factories;

use App\Models\Code;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Code>
 */
class CodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->imei(),
            'ticket_id' => Ticket::factory(10),
        ];
    }
}
