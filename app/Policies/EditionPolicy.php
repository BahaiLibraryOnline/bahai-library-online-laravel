<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Edition;
use Illuminate\Auth\Access\HandlesAuthorization;

class EditionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the edition can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the edition can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Edition  $model
     * @return mixed
     */
    public function view(User $user, Edition $model)
    {
        return true;
    }

    /**
     * Determine whether the edition can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the edition can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Edition  $model
     * @return mixed
     */
    public function update(User $user, Edition $model)
    {
        return true;
    }

    /**
     * Determine whether the edition can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Edition  $model
     * @return mixed
     */
    public function delete(User $user, Edition $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Edition  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the edition can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Edition  $model
     * @return mixed
     */
    public function restore(User $user, Edition $model)
    {
        return false;
    }

    /**
     * Determine whether the edition can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Edition  $model
     * @return mixed
     */
    public function forceDelete(User $user, Edition $model)
    {
        return false;
    }
}
