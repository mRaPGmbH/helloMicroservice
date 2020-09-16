<?php

namespace HelloCash\HelloMicroservice\Policies;

use HelloCash\HelloMicroservice\Interfaces\JwtUserInterface;
use Illuminate\Database\Eloquent\Model;
use HelloCash\HelloMicroservice\JwtUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class JwtPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param JwtUserInterface $user
     * @return bool
     */
    public function viewAny(JwtUserInterface $user): bool
    {
        if ($user->getClaim('adm') === true) {
            return true; // OLD variant - TODO: remove this, when no longer needed.
        }
        return $user->getLevel() >= JwtUser::USER_READONLY;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param JwtUserInterface $user
     * @param Model|null $model
     * @return bool
     */
    public function view(JwtUserInterface $user, Model $model = null): bool
    {
        if ($user->getClaim('adm') === true) {
            return true; // OLD variant - TODO: remove this, when no longer needed.
        }
        return $user->getLevel() >= JwtUser::USER_READONLY;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param JwtUserInterface $user
     * @return bool
     */
    public function create(JwtUserInterface $user): bool
    {
        if ($user->getClaim('adm') === true) {
            return true; // OLD variant - TODO: remove this, when no longer needed.
        }
        return $user->getLevel() >= JwtUser::USER;
    }


    /**
     * Determine whether the user can update the model.
     *
     * @param JwtUserInterface $user
     * @param Model|null $model
     * @return bool
     */
    public function update(JwtUserInterface $user, Model $model = null): bool
    {
        if ($user->getClaim('adm') === true) {
            return true; // OLD variant - TODO: remove this, when no longer needed.
        }
        return $user->getLevel() >= JwtUser::USER;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param JwtUserInterface $user
     * @param Model|null $model
     * @return bool
     */
    public function delete(JwtUserInterface $user, Model $model = null): bool
    {
        if ($user->getClaim('adm') === true) {
            return true; // OLD variant - TODO: remove this, when no longer needed.
        }
        return $user->getLevel() >= JwtUser::USER;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param JwtUserInterface $user
     * @param Model|null $model
     * @return bool
     */
    public function restore(JwtUserInterface $user, Model $model = null): bool
    {
        return $user->getLevel() >= JwtUser::SUPER_ADMIN;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param JwtUserInterface $user
     * @param Model|null $model
     * @return bool
     */
    public function forceDelete(JwtUserInterface $user, Model $model = null): bool
    {
        return $user->getLevel() >= JwtUser::SUPER_ADMIN;
    }
}
