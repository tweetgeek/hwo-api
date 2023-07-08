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
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
//    use HasApiTokens;
    use HasFactory;

//    use HasProfilePhoto;
    use Notifiable;

//    use TwoFactorAuthenticatable;
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
        'has_welcome_onboarding'
    ];

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

    public function authorizeDevice(string $deviceId, array $device): Model
    {
        if ($userDevice = $this->userDevices()->where(UserDevice::FIELD_DEVICE_ID, $deviceId)->first()) {
            $userDevice->last_seen = Carbon::now();
            $userDevice->save();
            return $userDevice;
        }

        return $this->userDevices()->create([
            UserDevice::FIELD_DEVICE_ID => $deviceId,
            UserDevice::FIELD_PUSH_TOKEN => $device['pushToken'] ?? null,
            UserDevice::FIELD_BRAND => $device['brand'],
            UserDevice::FIELD_MANUFACTURER => $device['manufacturer'],
            UserDevice::FIELD_MODEL_NAME => $device['modelName'],
            UserDevice::FIELD_MODEL_ID => $device['modelId'],
            UserDevice::FIELD_OS_NAME => $device['osName'],
            UserDevice::FIELD_OS_VERSION => $device['osVersion'],
            UserDevice::FIELD_OS_BUILD_ID => $device['osBuildId'],
            UserDevice::FIELD_DEVICE_NAME => $device['deviceName'],
            UserDevice::FIELD_LAST_SEEN => Carbon::now(),
        ]);
    }

    public function routeNotificationForExpo($notification): array
    {
        return $this->userDevices()->whereNotNull(UserDevice::FIELD_PUSH_TOKEN)->pluck(UserDevice::FIELD_PUSH_TOKEN)->toArray();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
