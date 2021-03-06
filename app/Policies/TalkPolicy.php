<?php

namespace App\Policies;

use App\Models\Talk;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TalkPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->isAdmin() || $user->isOrga())
            return true;
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Talk  $talk
     * @return mixed
     */
    public function view(User $user, Talk $talk)
    {
        return $user->id === $talk->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user ? true : false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Talk  $talk
     * @return mixed
     */
    public function update(User $user, Talk $talk)
    {
        return $user->id === $talk->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Talk  $talk
     * @return mixed
     */
    public function delete(User $user, Talk $talk)
    {
        return $user->id === $talk->user_id;
    }
}
