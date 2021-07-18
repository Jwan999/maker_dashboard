<?php

namespace App\Policies;

use App\Models\Base;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BasePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Base $base
     * @return mixed
     */
    public function view(User $user, Base $base)
    {
        return true;

    }

    /**
     * Determine whether the user can create models.
     *
     * @param \App\Models\User $user
     * @return mixed
     */
    public function create(User $user)
    {
        $value = true;
        if ($user->name == 'Guest') {
            $value = false;
        }
        return $value;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Base $base
     * @return mixed
     */
    public function update(User $user, Base $base)
    {
        $value = true;
        if ($user->name == 'Guest') {
            $value = false;
        }
        return $value;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Base $base
     * @return mixed
     */
    public function delete(User $user, Base $base)
    {
        $value = true;
        if ($user->name == 'Guest') {
            $value = false;
        }
        return $value;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Base $base
     * @return mixed
     */
    public function restore(User $user, Base $base)
    {
        $value = true;
        if ($user->name == 'Guest') {
            $value = false;
        }
        return $value;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param \App\Models\User $user
     * @param \App\Models\Base $base
     * @return mixed
     */
    public function forceDelete(User $user, Base $base)
    {
        $value = true;
        if ($user->name == 'Guest') {
            $value = false;
        }
        return $value;
    }
}
