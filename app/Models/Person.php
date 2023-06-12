<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $guarded = [];

    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'person_id');
    }
}
