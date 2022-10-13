<?php

namespace App\Models;

use Database\Factories\UserGarbageScheduleFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGarbageSchedule extends Model
{
    use SoftDeletes;
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function garbageSchedule(): HasOne
    {
        return $this->hasOne(GarbageSchedule::class);
    }

    protected static function newFactory(): Factory
    {
        return UserGarbageScheduleFactory::new();
    }
}
