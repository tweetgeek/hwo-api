<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Providers\UserPermissionsProvider;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        foreach (UserRole::cases() as $role) {
            $permissions = UserPermissionsProvider::getPermissionsForRole($role);

            $role = Role::create(['name' => $role->value]);

            $rolePermissions = [];
            foreach ($permissions as $permission) {
                $rolePermissions[] = Permission::firstOrCreate(['name' => $permission]);
            }
            $role->givePermissionTo($rolePermissions);
        }
    }
}
