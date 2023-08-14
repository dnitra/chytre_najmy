<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;


    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            "name" => ["required", "string", "max:255"],
            "email" => [
                "required",
                "string",
                "email",
                "max:255",
                "unique:users",
            ],
            "password" => $this->passwordRules(),
            "terms" => Jetstream::hasTermsAndPrivacyPolicyFeature()
                ? ["accepted", "required"]
                : "",
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(
                User::create([
                    "name" => $input["name"],
                    "email" => $input["email"],
                    "password" => Hash::make($input["password"]),
                ]),
                function (User $user) {
                    $this->createTeam($user);
                }
            );
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(
            $team = Team::forceCreate([
                "user_id" => $user->id,
                "name" => "{$user->name}'s portfolio",
                "personal_team" => true,
            ])
        );
        app(PermissionRegistrar::class)->setPermissionsTeamId($team->id);
        $role = Role::create(['name' => 'owner','team_id'=> $team->id,'guard_name' => 'web']);
        $allPerrmissions = Permission::all();
        $role->syncPermissions($allPerrmissions);
        $user->syncRoles([$role->id]);
    }
}
