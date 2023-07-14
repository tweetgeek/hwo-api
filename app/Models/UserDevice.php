<?php

namespace App\Models;

use Database\Factories\UserDeviceFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    use HasFactory;

    public const FIELD_TYPE = 'type';
    public const FIELD_DEVICE_ID = 'device_id';
    public const FIELD_USER_ID = 'user_id';
    public const FIELD_IS_DEVICE = 'is_device';
    public const FIELD_DEVICE_TYPE = 'device_type';
    public const FIELD_MODEL_NAME = 'model_name';
    public const FIELD_OS_NAME = 'os_name';
    public const FIELD_OS_VERSION = 'os_version';
    public const FIELD_PUSH_TOKEN = 'push_token';
    public const FIELD_LAST_SEEN = 'last_seen';

    protected $fillable = [
        self::FIELD_DEVICE_ID,
        self::FIELD_USER_ID,
        self::FIELD_TYPE,
        self::FIELD_IS_DEVICE,
        self::FIELD_DEVICE_TYPE,
        self::FIELD_MODEL_NAME,
        self::FIELD_OS_NAME,
        self::FIELD_OS_VERSION,
        self::FIELD_PUSH_TOKEN,
        self::FIELD_LAST_SEEN,
    ];

    protected $casts = [
        self::FIELD_LAST_SEEN => 'datetime'
    ];

    public function scopeByDeviceId(Builder $query, int $userId, string $deviceId): void
    {
        $query->where(self::FIELD_DEVICE_ID, $deviceId)->where(self::FIELD_USER_ID, $userId);
    }

    protected static function newFactory(): Factory
    {
        return UserDeviceFactory::new();
    }
}
