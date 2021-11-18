<?php

namespace App\Policies;

use App\Models\Group\Group;
use App\User;

class GroupUsersPolicy
{
    public function permission(User $user, Group $group, int $index)
    {
        if($index==0){
            return false;
        }
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_users.'.$index.'.permission');
    }
    //
    public function view(User $user, Group $group, int $index){
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_users.'.$index.'.view');
    }
    //
    public function invite(User $user, Group $group, int $index){
        if($index==0){
            return false;
        }
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_users.'.$index.'.invite');
    }
    //
    public function remove(User $user, Group $group, int $index){
        if($index==0){
            return false;
        }
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_users.'.$index.'.remove');
    }
}
