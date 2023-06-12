<?php

namespace Database\Seeders;

use App\Models\Price;
use App\Repositories\PriceRepository;
use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    public function __construct(
        private PriceRepository $priceRepository
    )
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if ($this->priceRepository->isNotEmpty()) {
            return;
        }

        $this->priceRepository->create([
            'key' => 'default_offline_all',
            'value' => 33000,
        ]);

        $this->priceRepository->create([
            'key' => 'default_offline_item',
            'value' => 4000,
        ]);

        $this->priceRepository->create([
            'key' => 'default_online_all',
            'value' => 22000,
        ]);

        $this->priceRepository->create([
            'key' => 'default_online_item',
            'value' => 2100,
        ]);
    }
}
