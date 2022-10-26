<?php

namespace App\Models;

use App\Notifications\VerifyUser;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable;
    use Authorizable;
    use CanResetPassword;
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'verified_at' => 'datetime',
    ];

    protected $appends = [
        'has_welcome_onboarding'
    ];

    public function userVerificationCode(): HasOne
    {
        return $this->hasOne(UserVerificationCode::class);
    }

    public function userOnboarding(): HasOne
    {
        return $this->hasOne(UserOnboarding::class);
    }

    public function garbageSchedules(): HasManyThrough
    {
        return $this->hasManyThrough(
            GarbageSchedule::class,
            UserGarbageSchedule::class,
            'garbage_schedule_id',
            'id',
            'id',
            'id'
        )->orderBy('updated_at', 'desc');
    }

    public function userNotificationSetting(): HasOne
    {
        return $this->hasOne(UserNotificationSetting::class);
    }

    public function devices(): HasMany
    {
        return $this->hasMany(UserDevice::class);
    }

    protected static function newFactory(): Factory
    {
        return UserFactory::new();
    }

    public function getHasWelcomeOnboardingAttribute(): bool
    {
        return $this->userOnboarding()->where('name', 'welcome')->exists();
    }

    public function authorizeDevice(array $device): Model
    {
        if ($device['type'] === 'web') {
            return new UserDevice($device);
        }

        return $this->devices()->updateOrCreate([
            UserDevice::FIELD_TYPE => $device['type'],
            UserDevice::FIELD_BRAND => $device['brand'],
            UserDevice::FIELD_MANUFACTURER => $device['manufacturer'],
            UserDevice::FIELD_MODEL_NAME => $device['modelName'],
            UserDevice::FIELD_MODEL_ID => $device['modelId'],
            UserDevice::FIELD_OS_NAME => $device['osName'],
            UserDevice::FIELD_OS_VERSION => $device['osVersion'],
            UserDevice::FIELD_OS_BUILD_ID => $device['osBuildId'],
            UserDevice::FIELD_DEVICE_NAME => $device['deviceName'],
        ], [
            UserDevice::FIELD_LAST_SEEN => Carbon::now(),
        ]);
    }

    public function createNotificationSetting(): Model
    {
        return $this->notificationSetting()->create();
    }

    public function isVerified(): bool
    {
        return !is_null($this->verified_at);
    }

    public function markAsVerified(): bool
    {
        return $this->forceFill([
            'verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    public function sendVerificationCodeNotification(): void
    {
        $this->notify(new VerifyUser());
    }

    public function getEmailForVerificationCode(): string
    {
        return $this->email;
    }

    public function getVerificationCode(): string
    {
        return $this->userVerificationCode->code;
    }
}
