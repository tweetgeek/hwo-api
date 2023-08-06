<?php

namespace App\Models;

use Database\Factories\UserGarbageScheduleFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGarbageSchedule extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const FIELD_USER_ID = 'user_id';
    public const FIELD_NAME = 'name';
    public const FIELD_CODE = 'code';
    public const FIELD_IS_PUBLIC = 'is_public';
    public const FIELD_PLACE_ID = 'place_id';

    public $fillable = [
        self::FIELD_USER_ID,
        self::FIELD_NAME,
        self::FIELD_CODE,
        self::FIELD_IS_PUBLIC,
        self::FIELD_PLACE_ID,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function userGarbageCollections(): HasMany
    {
        return $this->hasMany(UserGarbageCollection::class);
    }

    public function userGarbageScheduleRoles(): HasMany
    {
        return $this->hasMany(UserGarbageScheduleRole::class);
    }

    protected static function newFactory(): Factory
    {
        return UserGarbageScheduleFactory::new();
    }
}
