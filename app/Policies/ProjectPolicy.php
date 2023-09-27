<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
// use MoonShine\Models\MoonshineUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Project $item)
    {
        return $user->moonshine_user_role_id === 1 ||$user->id === $item->author_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Project $item)
    {
        return $user->moonshine_user_role_id === 1 ||$user->id === $item->author_id;
    }

    public function delete(User $user, Project $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function restore(User $user, Project $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function forceDelete(User $user, Project $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function massDelete(User $user)
    {
        return false;
    }
}
