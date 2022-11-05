<?php

namespace App\Models;

use Database\Factories\UserOnboardingFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserOnboarding extends Model
{
    use HasFactory;

    public const ONBOARDING_WELCOME = 'welcome';
    public const FIELD_NAME = 'name';
    public const FIELD_VALUE = 'value';

    public $fillable = [
        self::FIELD_NAME,
        self::FIELD_VALUE,
    ];

    public $casts = [
        self::FIELD_VALUE => 'json'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function newFactory(): Factory
    {
        return UserOnboardingFactory::new();
    }
}
