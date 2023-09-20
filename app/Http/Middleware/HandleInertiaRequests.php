<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Spatie\Permission\PermissionRegistrar;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = "app";

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $user = auth()->user();
        $roles = $user ? $user->roles->pluck('name')->mapWithKeys(fn ($role) => ["is" . ucfirst($role) => true]) : [];
        $permissions = $user ? $user->getPermissionsViaRoles()->pluck('name')->mapWithKeys(fn ($permission) => [$permission => true]) : [];
        return array_merge(parent::share($request), [
            'myProperties' => $user?->properties()->with('address')->get(),
            'flash' => [
                'error' => fn () => $request->session()->get('error'),
                'success' => fn () => $request->session()->get('success'),
            ],
            'auth.user.roles' => $roles,
            'auth.user.permissions' => $permissions,
        ]);

    }
}
