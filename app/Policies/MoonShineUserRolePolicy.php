<?php

namespace App\Policies;

use MoonShine\Models\MoonShineUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Models\MoonshineUserRole;
use App\Models\User;

class MoonShineUserRolePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function view(User $user, MoonshineUserRole $role): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function create(User $user): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function update(User $user, MoonshineUserRole $role): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function delete(User $user, MoonshineUserRole $role): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function restore(User $user, MoonshineUserRole $role): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function forceDelete(User $user, MoonshineUserRole $role): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function massDelete(User $user): bool
    {
        return $user->moonshine_user_role_id === 1;
    }
}
