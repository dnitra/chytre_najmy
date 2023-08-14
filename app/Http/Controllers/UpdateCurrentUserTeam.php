<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Jetstream;

class UpdateCurrentUserTeam extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $team = Jetstream::newTeamModel()->findOrFail($request->team_id);

        if (! $request->user()->switchTeam($team)) {
            abort(403);
        }

        setPermissionsTeamId($team->id);
        $user = Auth::user();
        $user->unsetRelation('roles','permissions');
        $permissions = $user->getAllPermissions();
        $user->setRelation('roles', $permissions->pluck('roles')->flatten()->unique());
        $user->setRelation('permissions', $permissions->pluck('name')->flatten()->unique());

        return redirect(config('fortify.home'), 303);
    }
}
