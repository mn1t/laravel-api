<?php

namespace App\Policies;

use App\Exceptions\ApiException;
use App\Http\Traits\ResponseHelper;
use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    use ResponseHelper;
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
    public function view(User $user, Post $post): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        $daily_post_limit = 3;
        
        if(User::find($user->id)->posts_today >= $daily_post_limit){
            $this->failure('Исчерпан лимит публикаций на сегодня', 403);
        }
        
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Post $post): bool
    {
        if($post->user_id != $user->id){
            $this->failure('Изменить пост может только автор', 403);
        }

        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Post $post): bool
    {
        if($post->user_id != $user->id){
            $this->failure('Удалить пост может только автор', 403);
        }

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Post $post): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Post $post): bool
    {
        return false;
    }
}
