<?php

namespace App\Repositories;

use App\Models\Price;

class PriceRepository
{
    public function __construct(
        private Price $price
    )
    {
    }

    public function isNotEmpty(): bool {
        return $this->price->all()->isNotEmpty();
    }

    public function create(array $attributes): Price
    {
        return $this->price->create($attributes);
    }

    public function getByKeyOrFail(string $name): Price | null
    {
        return $this->price->where('key', $name)->firstOrFail();
    }

    public function getDefaultOnlineAllValue(): int
    {
        return $this->getByKeyOrFail(Price::DEFAULT_ONLINE_ALL)->value;
    }

    public function getDefaultOfflineAllValue(): int
    {
        return $this->getByKeyOrFail(Price::DEFAULT_OFFLINE_ALL)->value;
    }

    public function getDefaultOnlineItemValue(): int
    {
        return $this->getByKeyOrFail(Price::DEFAULT_ONLINE_ITEM)->value;
    }

    public function getDefaultOfflineItemValue(): int
    {
        return $this->getByKeyOrFail(Price::DEFAULT_OFFLINE_ITEM)->value;
    }
}