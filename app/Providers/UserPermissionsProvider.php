<?php

declare(strict_types=1);

namespace App\Providers;

use App\Enums\UserRole;

class UserPermissionsProvider
{
    public const NAME = 'name';

    public static function getPermissionsForRole(UserRole $role): array
    {
        $rolePermissions[UserRole::USER->value] = [
            self::NAME,
        ];
        $rolePermissions[UserRole::ADMIN->value] = [
            ...$rolePermissions[UserRole::USER->value],
        ];
        $rolePermissions[UserRole::SUPER_ADMIN->value] = [
            ...$rolePermissions[UserRole::ADMIN->value],
        ];

        return $rolePermissions[$role->value];
    }

}
