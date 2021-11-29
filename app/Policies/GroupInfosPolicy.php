<?php

namespace App\Policies;

use App\Models\Group\Group;
use App\User;

class GroupInfosPolicy
{
    //
    public function viewAny(User $user, Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_infos.viewAny');
    }
    //
    public function create(User $user, Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_infos.create');
    }
    //
    public function update(User $user, Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_infos.update');
    }
    //
    public function delete(User $user, Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_infos.delete');
    }
}
