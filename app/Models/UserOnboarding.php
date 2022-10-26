<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserOnboarding extends Model
{
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
}
