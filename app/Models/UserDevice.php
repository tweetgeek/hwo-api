<?php

namespace App\Models;

use Database\Factories\UserDeviceFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDevice extends Model
{
    use HasFactory;

    public const FIELD_TYPE = 'type';
    public const FIELD_BRAND = 'brand';
    public const FIELD_PUSH_TOKEN = 'push_token';
    public const FIELD_MANUFACTURER = 'manufacturer';
    public const FIELD_MODEL_NAME = 'model_name';
    public const FIELD_MODEL_ID = 'model_id';
    public const FIELD_OS_NAME = 'os_name';
    public const FIELD_OS_VERSION = 'os_version';
    public const FIELD_OS_BUILD_ID = 'os_build_id';
    public const FIELD_DEVICE_NAME = 'device_name';
    public const FIELD_LAST_SEEN = 'last_seen';

    protected $fillable = [
        self::FIELD_TYPE,
        self::FIELD_BRAND,
        self::FIELD_PUSH_TOKEN,
        self::FIELD_MANUFACTURER,
        self::FIELD_MODEL_NAME,
        self::FIELD_MODEL_ID,
        self::FIELD_OS_NAME,
        self::FIELD_OS_VERSION,
        self::FIELD_OS_BUILD_ID,
        self::FIELD_DEVICE_NAME,
        self::FIELD_LAST_SEEN,
    ];

    protected $casts = [
        self::FIELD_LAST_SEEN => 'datetime'
    ];

    protected static function newFactory(): Factory
    {
        return UserDeviceFactory::new();
    }
}
