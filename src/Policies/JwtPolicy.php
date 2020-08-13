<?php

namespace HelloCash\HelloMicroservice\Policies;

use Illuminate\Database\Eloquent\Model;
use HelloCash\HelloMicroservice\JwtUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class JwtPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param JwtUser $user
     * @return bool
     */
    public function viewAny(JwtUser $user): bool
    {
        return $user->getClaim('adm') === true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param JwtUser $user
     * @param Model|null $model
     * @return bool
     */
    public function view(JwtUser $user, Model $model = null): bool
    {
        return $user->getClaim('adm') === true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param JwtUser $user
     * @return bool
     */
    public function create(JwtUser $user): bool
    {
        return $user->getClaim('adm') === true;
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param JwtUser $user
     * @param Model|null $model
     * @return bool
     */
    public function update(JwtUser $user, Model $model = null): bool
    {
        return $user->getClaim('adm') === true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param JwtUser $user
     * @param Model|null $model
     * @return bool
     */
    public function delete(JwtUser $user, Model $model = null): bool
    {
        return $user->getClaim('adm') === true;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param JwtUser $user
     * @param Model|null $model
     * @return bool
     */
    public function restore(JwtUser $user, Model $model = null): bool
    {
        return $user->getClaim('adm') === true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param JwtUser $user
     * @param Model|null $model
     * @return bool
     */
    public function forceDelete(JwtUser $user, Model $model = null): bool
    {
        return $user->getClaim('adm') === true;
    }
}
