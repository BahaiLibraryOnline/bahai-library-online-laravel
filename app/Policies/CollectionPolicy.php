<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Collection;
use Illuminate\Auth\Access\HandlesAuthorization;

class CollectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the collection can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the collection can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Collection  $model
     * @return mixed
     */
    public function view(User $user, Collection $model)
    {
        return true;
    }

    /**
     * Determine whether the collection can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the collection can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Collection  $model
     * @return mixed
     */
    public function update(User $user, Collection $model)
    {
        return true;
    }

    /**
     * Determine whether the collection can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Collection  $model
     * @return mixed
     */
    public function delete(User $user, Collection $model)
    {
        return true;
    }

    /**
     * Determine whether the collection can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Collection  $model
     * @return mixed
     */
    public function restore(User $user, Collection $model)
    {
        return false;
    }

    /**
     * Determine whether the collection can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Collection  $model
     * @return mixed
     */
    public function forceDelete(User $user, Collection $model)
    {
        return false;
    }
}
