<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property-read string name
 * @property-read Collection<Report> $reports
 */
class Ticket extends Model
{
    use HasFactory;

    public const TYPE_ONLINE = 'online';
    public const TYPE_OFFLINE = 'offline';

    protected $guarded = [];

    public function type(): BelongsTo
    {
        return $this->belongsTo(TicketType::class, 'type_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('cost');
    }

    public function reports(): BelongsToMany
    {
        return $this->belongsToMany(Report::class);
    }

    public function code(): HasOne
    {
        return $this->hasOne(Code::class);
    }

    public function link(): HasOne
    {
        return $this->hasOne(Link::class);
    }

    public function cost(): int
    {
        return (int)$this->users->first()->pivot->cost;
    }
}
