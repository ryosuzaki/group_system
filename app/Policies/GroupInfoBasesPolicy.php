<?php

namespace App\Policies;

use App\Models\Group\Group;
use App\User;

class GroupInfoBasesPolicy
{
    //
    public function viewAny(User $user, Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_info_bases.viewAny');
    }
    //
    public function create(User $user, Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_info_bases.create');
    }
    //
    public function update(User $user, Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_info_bases.update');
    }
    //
    public function delete(User $user, Group $group)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_info_bases.delete');
    }
}
