<?php

namespace App\Models;

use Database\Factories\GarbageCollectionFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GarbageCollection extends Model
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

    public function garbageSchedule(): BelongsTo
    {
        return $this->belongsTo(GarbageSchedule::class);
    }

    protected static function newFactory(): Factory
    {
        return GarbageCollectionFactory::new();
    }
}
