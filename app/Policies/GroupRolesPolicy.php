<?php

namespace App\Policies;

use App\Models\Group\Group;
use App\User;

class GroupRolesPolicy
{
    //
    public function viewAny(User $user,Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_roles.viewAny');
    }
    //
    public function create(User $user, Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_roles.create');
    }
    //
    public function update(User $user,Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_roles.update');
    }
    //
    public function delete(User $user, Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_roles.delete');
    }
}
