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
     * App\Models\GarbageCollection
     *
     * @property int $id
     * @property int $garbage_schedule_id
     * @property int $garbage_type_id
     * @property string $date
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property string|null $deleted_at
     * @property-read \App\Models\GarbageType $garbageType
     * @method static \Database\Factories\GarbageCollectionFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageCollection newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageCollection newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageCollection query()
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageCollection whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageCollection whereDate($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageCollection whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageCollection whereGarbageScheduleId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageCollection whereGarbageTypeId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageCollection whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageCollection whereUpdatedAt($value)
     */
    class GarbageCollection extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\GarbageSchedule
     *
     * @property int $id
     * @property string $name
     * @property string $code
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GarbageCollection[] $availableGarbageCollections
     * @property-read int|null $available_garbage_collections_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GarbageCollection[] $garbageCollections
     * @property-read int|null $garbage_collections_count
     * @method static \Database\Factories\GarbageScheduleFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageSchedule newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageSchedule newQuery()
     * @method static \Illuminate\Database\Query\Builder|GarbageSchedule onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageSchedule query()
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageSchedule whereCode($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageSchedule whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageSchedule whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageSchedule whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageSchedule whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageSchedule whereUpdatedAt($value)
     * @method static \Illuminate\Database\Query\Builder|GarbageSchedule withTrashed()
     * @method static \Illuminate\Database\Query\Builder|GarbageSchedule withoutTrashed()
     */
    class GarbageSchedule extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\GarbageType
     *
     * @property int $id
     * @property int|null $user_id
     * @property string $name
     * @property string|null $icon
     * @property string|null $color
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property string|null $deleted_at
     * @method static \Database\Factories\GarbageTypeFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageType newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageType newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageType query()
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereColor($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereIcon($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|GarbageType whereUserId($value)
     */
    class GarbageType extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\User
     *
     * @property int $id
     * @property string $name
     * @property string $email
     * @property string|null $email_verified_at
     * @property string $password
     * @property string|null $remember_token
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserDevice[] $devices
     * @property-read int|null $devices_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GarbageSchedule[] $garbageSchedules
     * @property-read int|null $garbage_schedules_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GarbageType[] $garbageTypes
     * @property-read int|null $garbage_types_count
     * @property-read bool $has_onboarding
     * @property-read \App\Models\UserNotificationSetting|null $notificationSetting
     * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
     * @property-read int|null $notifications_count
     * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
     * @property-read int|null $tokens_count
     * @property-read \App\Models\UserVerificationCode|null $verificationCode
     * @method static \Database\Factories\UserFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|User query()
     * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
     * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
     */
    class User extends \Eloquent implements \Illuminate\Contracts\Auth\Authenticatable, \Illuminate\Contracts\Auth\Access\Authorizable, \Illuminate\Contracts\Auth\CanResetPassword
    {
    }
}

namespace App\Models{
    /**
     * App\Models\UserDevice
     *
     * @property int $id
     * @property int $user_id
     * @property string $type
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
     * @method static \Database\Factories\UserDeviceFactory factory(...$parameters)
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
     * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereType($value)
     * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|UserDevice whereUserId($value)
     */
    class UserDevice extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\UserGarbageSchedule
     *
     * @property int $id
     * @property int $user_id
     * @property int $garbage_schedule_id
     * @property string $role
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     * @property \Illuminate\Support\Carbon|null $deleted_at
     * @property-read \App\Models\GarbageSchedule|null $garbageSchedule
     * @property-read \App\Models\User $user
     * @method static \Database\Factories\UserGarbageScheduleFactory factory(...$parameters)
     * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule newQuery()
     * @method static \Illuminate\Database\Query\Builder|UserGarbageSchedule onlyTrashed()
     * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule query()
     * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereCreatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereDeletedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereGarbageScheduleId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereId($value)
     * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereRole($value)
     * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereUpdatedAt($value)
     * @method static \Illuminate\Database\Eloquent\Builder|UserGarbageSchedule whereUserId($value)
     * @method static \Illuminate\Database\Query\Builder|UserGarbageSchedule withTrashed()
     * @method static \Illuminate\Database\Query\Builder|UserGarbageSchedule withoutTrashed()
     */
    class UserGarbageSchedule extends \Eloquent
    {
    }
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
     * @method static \Database\Factories\UserNotificationSettingFactory factory(...$parameters)
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
    class UserNotificationSetting extends \Eloquent
    {
    }
}

namespace App\Models{
    /**
     * App\Models\UserVerificationCode
     *
     * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationCode newModelQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationCode newQuery()
     * @method static \Illuminate\Database\Eloquent\Builder|UserVerificationCode query()
     */
    class UserVerificationCode extends \Eloquent
    {
    }
}
