<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TicketType extends Model
{
    use HasFactory;

    public function tickets(): HasOne
    {
        return $this->hasOne(Ticket::class, 'type_id');
    }
}
