<?php

namespace App\Policies;

use MoonShine\Models\MoonShineUser;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\User;

class MoonShineUserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function view(User $user, MoonShineUser $moonShineUser): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function create(User $user): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function update(User $user, MoonShineUser $moonShineUser): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function delete(User $user, MoonShineUser $moonShineUser): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function restore(User $user, MoonShineUser $moonShineUser): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function forceDelete(User $user, MoonShineUser $moonShineUser): bool
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function massDelete(User $user): bool
    {
        return $user->moonshine_user_role_id === 1;
    }
}
