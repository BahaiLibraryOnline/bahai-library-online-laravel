<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Creator;
use Illuminate\Auth\Access\HandlesAuthorization;

class CreatorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the creator can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the creator can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Creator  $model
     * @return mixed
     */
    public function view(User $user, Creator $model)
    {
        return true;
    }

    /**
     * Determine whether the creator can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the creator can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Creator  $model
     * @return mixed
     */
    public function update(User $user, Creator $model)
    {
        return true;
    }

    /**
     * Determine whether the creator can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Creator  $model
     * @return mixed
     */
    public function delete(User $user, Creator $model)
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Creator  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the creator can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Creator  $model
     * @return mixed
     */
    public function restore(User $user, Creator $model)
    {
        return false;
    }

    /**
     * Determine whether the creator can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Creator  $model
     * @return mixed
     */
    public function forceDelete(User $user, Creator $model)
    {
        return false;
    }
}
