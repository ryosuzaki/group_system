<?php

namespace App\Policies;

use App\Models\Group\Group;
use App\User;

class GroupInfoPolicy
{
    //
    public function view(User $user, Group $group,int $index)
    {
        if($group->getInfoBaseByIndex($index)->viewable){
            return true;
        }
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_info.'.$index.'.view');
    }

    //
    public function update(User $user, Group $group,int $index)
    {
        $role=$user->getRoleByGroup($group->id);
        if (!$role){
            return false;
        }
        return $role->hasPermissionTo('group_info.'.$index.'.update');
    }
}
