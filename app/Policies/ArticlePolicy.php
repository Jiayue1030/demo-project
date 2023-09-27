<?php

namespace App\Policies;

use App\Models\Article;
use Illuminate\Auth\Access\HandlesAuthorization;
use MoonShine\Models\MoonshineUser;
use App\Models\User;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return true;
    }

    public function view(User $user, Article $item)
    {
        return $user->moonshine_user_role_id === 1 ||$user->id === $item->author_id;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Article $item)
    {
        return $user->moonshine_user_role_id === 1 ||$user->id === $item->author_id;
    }

    public function delete(User $user, Article $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function restore(User $user, Article $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function forceDelete(User $user, Article $item)
    {
        return $user->moonshine_user_role_id === 1;
    }

    public function massDelete(User $user)
    {
        return false;
    }
}
