<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Address;
use App\Models\PropertyType;
use Database\Factories\AddressFactory;
use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\Country;
use App\Models\Team;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Address::factory(15)->create();
            $this->call([
                PropertyTypeSeeder::class,
                CountrySeeder::class,
                PropertySeeder::class,
                RolesAndPermissionsSeeder::class
            ]);

        $user = User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
        ]);
        $user->ownedTeams()->save(
            $team = Team::forceCreate([
                "user_id" => $user->id,
                "name" => "{$user->name}'s portfolio",
                "personal_team" => true,
            ])
        );
        $team->users()->syncWithoutDetaching($user->id);
        app(PermissionRegistrar::class)->setPermissionsTeamId($team->id);
        $role = Role::create(['name' => 'owner','team_id'=> $team->id]);
        $allPerrmissions = Permission::all();
        $role->syncPermissions($allPerrmissions);
        $user->syncRoles([$role->id]);
    }
}
