<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): bool
    {
        return $this->hasPermission($user, $team, 'view teams');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        return $this->hasPermission($user, $team, 'update teams');
    }

    /**
     * Determine whether the user can add team members.
     */
    public function addTeamMember(User $user, Team $team): bool
    {
        return $this->hasPermission($user, $team, 'add team members');
    }

    /**
     * Determine whether the user can update team member permissions.
     */
    public function updateTeamMember(User $user, Team $team): bool
    {
        return $this->hasPermission($user, $team, 'update team members');
    }

    /**
     * Determine whether the user can remove team members.
     */
    public function removeTeamMember(User $user, Team $team): bool
    {
        return $this->hasPermission($user, $team, 'remove team members');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return $this->hasPermission($user, $team, 'delete teams');
    }

    /**
     * Check if the user has a specific permission for the team.
     */
    private function hasPermission(User $user, Team $team, string $permissionName): bool
    {
        $userRoleInTeam = $user->roles->where('team_id', $team->id)->first();
        if ($userRoleInTeam) {
            $rolePermissions = $userRoleInTeam->permissions->pluck('name')->toArray();
            return in_array($permissionName, $rolePermissions);
        }

        $userPerrmissions = $user->permissions->where('name', $permissionName)->first();
        if ($userPerrmissions) {
            return true;
        }

        return false;
    }
}
