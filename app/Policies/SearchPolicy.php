<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Search;
use Illuminate\Auth\Access\HandlesAuthorization;

class SearchPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the search can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the search can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Search  $model
     * @return mixed
     */
    public function view(User $user, Search $model)
    {
        return true;
    }

    /**
     * Determine whether the search can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the search can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Search  $model
     * @return mixed
     */
    public function update(User $user, Search $model)
    {
        return true;
    }

    /**
     * Determine whether the search can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Search  $model
     * @return mixed
     */
    public function delete(User $user, Search $model)
    {
        return true;
    }

    /**
     * Determine whether the search can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Search  $model
     * @return mixed
     */
    public function restore(User $user, Search $model)
    {
        return false;
    }

    /**
     * Determine whether the search can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Search  $model
     * @return mixed
     */
    public function forceDelete(User $user, Search $model)
    {
        return false;
    }
}
