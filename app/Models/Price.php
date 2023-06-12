<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $key
 * @property-read int $value
 */
class Price extends Model
{
    use HasFactory;

    public const DEFAULT_OFFLINE_ALL = 'default_offline_all';
    public const DEFAULT_OFFLINE_ITEM = 'default_offline_item';
    public const DEFAULT_ONLINE_ALL = 'default_online_all';
    public const DEFAULT_ONLINE_ITEM = 'default_online_item';

    protected $guarded = [];
}
