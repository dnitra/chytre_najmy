<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeamPolicy
{
    use HandlesAuthorization;
//$propertyPermission = ['canCreatePropertyTypes', 'canViewPropertyTypes', 'canEditPropertyTypes', 'canDeletePropertyTypes'];
//$teamPerrmissions = ['canCreateTeams', 'canViewTeams', 'canEditTeams', 'canDeleteTeams', 'canAddTeamMembers', 'canUpdateTeamMembers', 'canDeleteTeamMembers'];
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
        return $this->hasPermission($user, $team, 'canViewTeams');
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
        return $this->hasPermission($user, $team, 'canEditTeams');
    }

    /**
     * Determine whether the user can add team members.
     */
    public function addTeamMember(User $user, Team $team): bool
    {
        return $this->hasPermission($user, $team, 'canAddTeamMembers');
    }

    /**
     * Determine whether the user can update team member permissions.
     */
    public function updateTeamMember(User $user, Team $team): bool
    {
        return $this->hasPermission($user, $team, 'canUpdateTeamMembers');
    }

    /**
     * Determine whether the user can remove team members.
     */
    public function removeTeamMember(User $user, Team $team): bool
    {
        return $this->hasPermission($user, $team, 'canDeleteTeamMembers');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return $this->hasPermission($user, $team, 'canDeleteTeams');
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
