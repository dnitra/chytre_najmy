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
        $teamPerrmissions = ['create teams', 'view teams', 'edit teams', 'delete teams', 'add team members', 'update team members', 'delete team members'];

        foreach ($propertyPermission as $permission) {
            Permission::findOrCreate($permission);
        }
        foreach ($teamPerrmissions as $permission) {
            Permission::findOrCreate($permission);
        }

    }
}
