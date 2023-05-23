<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\GarbageType
 *
 * @property int $id
 * @property string $name
 * @property string|null $icon
 * @property string|null $color
 * @property int|null $primary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\GarbageTypeFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|GarbageType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GarbageType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GarbageType query()
 * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GarbageType wherePrimary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereUpdatedAt($value)
 */
	class GarbageType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read bool $has_welcome_onboarding
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserDevice> $userDevices
 * @property-read int|null $user_devices_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserGarbageSchedule> $userGarbageSchedules
 * @property-read int|null $user_garbage_schedules_count
 * @property-read \App\Models\UserNotificationSetting|null $userNotificationSetting
 * @property-read \App\Models\UserOnboarding|null $userOnboarding
 * @property-read \App\Models\UserVerificationCode|null $userVerificationCode
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserDevice
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string|null $push_token
 * @property string|null $brand
 * @property string|null $manufacturer
 * @property string|null $model_name
 * @property string|null $model_id
 * @property string|null $os_name
 * @property string|null $os_version
 * @property string|null $os_build_id
 * @property string|null $device_name
 * @property \Illuminate\Support\Carbon|null $last_seen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserDeviceFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereDeviceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereLastSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereManufacturer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereModelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereOsBuildId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereOsName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereOsVersion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice wherePushToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereUserId($value)
 */
	class UserDevice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserGarbageCollection
 *
 * @property int $id
 * @property int $user_garbage_schedule_id
 * @property int $garbage_type_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\GarbageType $garbageType
 * @property-read \App\Models\UserGarbageSchedule $userGarbageSchedule
 * @method static \Database\Factories\UserGarbageCollectionFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageCollection newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageCollection newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageCollection query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageCollection whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageCollection whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageCollection whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageCollection whereGarbageTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageCollection whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageCollection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageCollection whereUserGarbageScheduleId($value)
 */
	class UserGarbageCollection extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserGarbageSchedule
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\UserGarbageCollection> $userGarbageCollections
 * @property-read int|null $user_garbage_collections_count
 * @method static \Database\Factories\UserGarbageScheduleFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule withoutTrashed()
 */
	class UserGarbageSchedule extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserGarbageScheduleRole
 *
 * @property int $id
 * @property int $user_id
 * @property int $user_garbage_schedule_id
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole whereUserGarbageScheduleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageScheduleRole withoutTrashed()
 */
	class UserGarbageScheduleRole extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserNotificationSetting
 *
 * @property int $id
 * @property int $user_id
 * @property int $send_to_email
 * @property int $send_to_app
 * @property int $notify_day
 * @property string $at_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\UserNotificationSettingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotificationSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotificationSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotificationSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotificationSetting whereAtTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotificationSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotificationSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotificationSetting whereNotifyDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotificationSetting whereSendToApp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotificationSetting whereSendToEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotificationSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotificationSetting whereUserId($value)
 */
	class UserNotificationSetting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserOnboarding
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property array|null $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\UserOnboardingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|UserOnboarding newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserOnboarding newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserOnboarding query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserOnboarding whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserOnboarding whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserOnboarding whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserOnboarding whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserOnboarding whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserOnboarding whereValue($value)
 */
	class UserOnboarding extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserVerificationCode
 *
 * @property int $id
 * @property int $user_id
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationCode whereUserId($value)
 */
	class UserVerificationCode extends \Eloquent {}
}

