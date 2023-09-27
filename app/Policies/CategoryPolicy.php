<?php

namespace App\Policies;

use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Models\MoonshineUser;
use App\Models\User;

class CategoryPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Category $item)
    {
        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Category $item)
    {
        return true;
    }

    public function delete(User $user, Category $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function restore(User $user, Category $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function forceDelete(User $user, Category $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function massDelete(User $user)
    {
        return $user->moonshine_user_role_id === 1;
    }
}
