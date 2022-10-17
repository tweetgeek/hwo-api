<?php

namespace App\Models;

use Database\Factories\UserNotificationSettingFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotificationSetting extends Model
{
    use HasFactory;

    public const FIELD_TYPE = 'type';


    protected $fillable = [
        self::FIELD_TYPE,
    ];


    protected static function newFactory(): Factory
    {
        return UserNotificationSettingFactory::new();
    }
}
