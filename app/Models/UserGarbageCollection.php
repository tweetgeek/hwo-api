<?php

namespace App\Models;

use Database\Factories\UserGarbageCollectionFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserGarbageCollection extends Model
{
    use HasFactory;

    public const FIELD_USER_GARBAGE_SCHEDULE_ID = 'user_garbage_schedule_id';
    public const FIELD_GARBAGE_TYPE_ID = 'garbage_type_id';
    public const FIELD_DATE = 'date';

    public $fillable = [
        self::FIELD_USER_GARBAGE_SCHEDULE_ID,
        self::FIELD_GARBAGE_TYPE_ID,
        self::FIELD_DATE,
    ];

    public function garbageType(): BelongsTo
    {
        return $this->belongsTo(GarbageType::class);
    }

    public function userGarbageSchedule(): BelongsTo
    {
        return $this->belongsTo(UserGarbageSchedule::class);
    }

    protected static function newFactory(): Factory
    {
        return UserGarbageCollectionFactory::new();
    }
}
