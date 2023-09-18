<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use MoonShine\Models\MoonShineUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user)
    {
        return true;
    }

    public function view(MoonshineUser $user, Project $item)
    {
        return $user->moonshine_user_role_id === 1 ||$user->id === $item->author_id;
    }

    public function create(MoonshineUser $user)
    {
        return true;
    }

    public function update(MoonshineUser $user, Project $item)
    {
        return $user->moonshine_user_role_id === 1 ||$user->id === $item->author_id;
    }

    public function delete(MoonshineUser $user, Project $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function restore(MoonshineUser $user, Project $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function forceDelete(MoonshineUser $user, Project $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function massDelete(MoonshineUser $user)
    {
        return false;
    }
}
