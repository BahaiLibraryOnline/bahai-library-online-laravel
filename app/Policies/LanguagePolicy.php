<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Language;
use Illuminate\Auth\Access\HandlesAuthorization;

class LanguagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the language can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the language can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Language  $model
     * @return mixed
     */
    public function view(User $user, Language $model)
    {
        return true;
    }

    /**
     * Determine whether the language can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the language can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Language  $model
     * @return mixed
     */
    public function update(User $user, Language $model)
    {
        return true;
    }

    /**
     * Determine whether the language can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Language  $model
     * @return mixed
     */
    public function delete(User $user, Language $model)
    {
        return true;
    }

    /**
     * Determine whether the language can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Language  $model
     * @return mixed
     */
    public function restore(User $user, Language $model)
    {
        return false;
    }

    /**
     * Determine whether the language can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Language  $model
     * @return mixed
     */
    public function forceDelete(User $user, Language $model)
    {
        return false;
    }
}
