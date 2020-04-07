<?php

namespace App\Policies;

use http\Env\Response;
use  Spatie\Permission\Models\Role as Role;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any roles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
        return $user->hasAnyPermission(['Publish' ,'View','Edit','Delete']);
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param \App\User $user
     * @param Role $role
     * @return mixed
     */
    public function view(User $user, Role $role)
    {
        //

        return $user->hasAnyPermission(['Publish' ,'View','Delete']);


    }

    /**
     * Determine whether the user can create roles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
        return $user->hasAnyPermission([  'Edit' ,'View']);
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param \App\User $user
     * @param Role $role
     * @return mixed
     */
    public function update(User $user, Role $role)
    {
        //

         return $user->hasAnyPermission([  'Edit' ,'View','Publish']);




    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param \App\User $user
     * @param Role $role
     * @return mixed
     */
    public function delete(User $user, Role $role)
    {
        //
        return $user->hasAnyPermission([  'Publish' ,'View']);
    }

    /**
     * Determine whether the user can restore the role.
     *
     * @param \App\User $user
     * @param Role $role
     * @return mixed
     */
    public function restore(User $user, Role $role)
    {
        return $user->hasAnyPermission([  'Publish' ,'View']);
        //
    }

    /**
     * Determine whether the user can permanently delete the role.
     *
     * @param \App\User $user
     * @param Role $role
     * @return mixed
     */
    public function forceDelete(User $user, Role $role)
    {
        //
        return $user->hasAnyPermission([  'Publish' ,'View']);
    }
}
