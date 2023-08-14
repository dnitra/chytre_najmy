<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $propertyPermission = ['create property types', 'view property types', 'edit property types', 'delete property types'];
        $userPermission = ['create users', 'view users', 'edit users', 'delete users'];
        $ownerRole = Role::create(['name' => 'owner']);
        $mangerRole = Role::create(['name' => 'manager']);
        $agentRole = Role::create(['name' => 'agent']);

        foreach ($propertyPermission as $permission) {
            $permission = Permission::create(['name' => $permission]);
            $ownerRole->givePermissionTo($permission);
            $mangerRole->givePermissionTo($permission);
            $agentRole->givePermissionTo($permission);
        }
        foreach ($userPermission as $permission) {
            $permission = Permission::create(['name' => $permission]);
            $ownerRole->givePermissionTo($permission);
            if ($permission !== 'delete users') {
                $mangerRole->givePermissionTo($permission);
            }
        }

    }
}
