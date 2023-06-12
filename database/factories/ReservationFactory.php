<?php

namespace Database\Factories;

use App\Models\Reservation;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use DateInterval;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {
        $reserved = new CarbonImmutable(fake()->dateTimeBetween(
            Carbon::parse(now()->year - 1 . '-09-01'),
            Carbon::parse(now()->year - 1 . '-09-30'),
        ));

        $numberStart = fake()->numberBetween(1, 9);
        $in = (new CarbonImmutable($reserved))->add(DateInterval::createFromDateString($numberStart . ' day'));
        $out =  (new CarbonImmutable($reserved))->add(DateInterval::createFromDateString($numberStart + 7 . ' days'));

        return [
            'room_number' => fake()->numberBetween(1, 100),
            'check_in_date' => $in,
            'check_out_date' => $out,
            'reserved_at' => $reserved,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
