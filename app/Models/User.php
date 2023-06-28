<?php

namespace App\Models;

use App\Notifications\VerifyUser;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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

    public function userGarbageSchedules(): HasMany
    {
        return $this->hasMany(UserGarbageSchedule::class);
    }

    public function userNotificationSetting(): HasOne
    {
        return $this->hasOne(UserNotificationSetting::class);
    }

    public function userDevices(): HasMany
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

        return $this->userDevices()->updateOrCreate([
            UserDevice::FIELD_TYPE => $device['type'],
            UserDevice::FIELD_PUSH_TOKEN => $device['pushToken'] ?? null,
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

    public function routeNotificationForExpo($notification): array
    {
        return $this->userDevices()->whereNotNull(UserDevice::FIELD_PUSH_TOKEN)->pluck(UserDevice::FIELD_PUSH_TOKEN)->toArray();
    }
}
