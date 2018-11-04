<?php

namespace Pilot\Policies;

use Pilot\User;
use Pilot\News;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create news.
     *
     * @param  \Pilot\User  $user
     * @return mixed
     */
    public function createNews(User $user)
    {
        
    }

    /**
     * Determine whether the user can update the news.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\News  $news
     * @return mixed
     */
    public function updateNews(User $user, News $news)
    {
        return $user->id === $news->user_id;
    }

    /**
     * Determine whether the user can delete the news.
     *
     * @param  \Pilot\User  $user
     * @param  \Pilot\News  $news
     * @return mixed
     */
    public function deleteNews(User $user, News $news)
    {
        return $user->id === $news->user_id;
    }
}
