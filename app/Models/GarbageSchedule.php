<?php

namespace App\Models;

use Database\Factories\GarbageScheduleFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class GarbageSchedule extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const FIELD_NAME = 'name';
    public const FIELD_CODE = 'code';
    public const FIELD_USER_ID = 'user_id';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function garbageCollections(): HasMany
    {
        return $this->hasMany(GarbageCollection::class);
    }

    protected static function newFactory(): Factory
    {
        return GarbageScheduleFactory::new();
    }
}
