<?php

namespace App\Actions\Jetstream;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Contracts\CreatesTeams;
use Laravel\Jetstream\Events\AddingTeam;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateTeam implements CreatesTeams
{
    /**
     * Validate and create a new team for the given user.
     *
     * @param  array<string, string>  $input
     */
    public function create(User $user, array $input)
    {
        Gate::forUser($user)->authorize("create", Jetstream::newTeamModel());

        Validator::make($input, [
            "name" => ["required", "string", "max:255"],
        ])->validateWithBag("createTeam");

        AddingTeam::dispatch($user);

        $team = $user->ownedTeams()->create([
            "name" => $input["name"],
            "personal_team" => false,
        ]);
        $user->switchTeam(
            $team
        );
        setPermissionsTeamId($team->id);
        $user = Auth::user();
        $user->unsetRelation('roles','permissions');
        $role = Role::create(['name' => 'owner','team_id'=> $team->id,'guard_name' => 'web']);
        $allPerrmissions = Permission::all();
        $role->syncPermissions($allPerrmissions);
        $user->syncRoles([$role->id]);

        return $team;
    }
}
