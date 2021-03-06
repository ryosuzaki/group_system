<?php

namespace App\Models\Group;
use Illuminate\Database\Eloquent\Model;

use App\User;

use App\Models\Group\GroupType;

use App\Traits\UseInfo;
use App\Traits\UseRoleInModel;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class Group extends Model
{
    use UseInfo{
        UseInfo::getViewableInfos as trait_getViewableInfos;
    }
    use UseRoleInModel;

    //
    protected $guarded = ['id'];
    //
    protected $with = ['type'];

    /**
     * 
     */
    public function getPermissionsAttribute(){
        $permission_config=config("group_system.group_types.".$this->type->name.".permission");
        //
        $permissions=[];
        $permissions[]='group.*';
        foreach(config('group_system.role.group') as $action){
            $permissions[]='group.'.$action;
        }
        //
        if($permission_config["group_infos"]){
            $permissions[]='group_infos.*';
            foreach(config('group_system.role.group_infos') as $action){
                $permissions[]='group_infos.'.$action;
            }
        }
        //
        $permissions[]='group_info.*';
        foreach($this->getInfos() as $info){
            $permissions[]='group_info.'.$info->index.'.*';
            foreach(config('group_system.role.group_info') as $action){
                $permissions[]='group_info.'.$info->index.'.'.$action;
            }
        }
        //
        if($permission_config["group_roles"]){
            $permissions[]='group_roles.*';
            foreach(config('group_system.role.group_roles') as $action){
                $permissions[]='group_roles.'.$action;
            }
        }
        //
        $permissions[]='group_users.*';
        foreach($this->roles()->get() as $role){
            $permissions[]='group_users.'.$role->index.'.*';
            foreach(config('group_system.role.group_users') as $action){
                $permissions[]='group_users.'.$role->index.'.'.$action;
            }
        }
        return $permissions;
    }


    /**
     * 
     */
    public static function setUp($user,string $name,GroupType $type,string $admin_password){
        //
        if(is_int($user)){
            $user=User::find($user);
        }
        //
        $group=$type->groups()->create([
            'name'=>$name,
        ]);
        //
        foreach($type->initial_info as $template){
            $group->createInfo($template);
        }
        //
        $admin_config=$type->admin;
        //
        $admin=$group->createRole($admin_config['name'],$admin_password);
        //
        $admin->syncPermissions($group->permissions);
        //
        $group->inviteUser($user,$admin->id);
        return $group;
    }
    
    /**
     * 
     */
    public function tearDown(){
        $this->BeforeDeleteModelUsingRole();
        $this->BeforeDeleteModelUsingInfo();
        return $this->delete();
    }


    /**
     * 
     */
    public function type(){
        return $this->belongsTo('App\Models\Group\GroupType','group_type_id');
    }


    /**
     * 
     */
    public function getViewableUserInfos($user){
        $infos=[];
        foreach ($this->type->viewable_user_infos as $info){
            $infos[]=$this->getUserInfo($user,$info);
        }
        return $infos;
    }
    
    /**
     * 
     */
    public function getViewableUserInfo($user,$template){
        $user=$this->getUserWithPivot($user);
        $template=$user->getTemplate($template);
        foreach($this->getViewableUserInfos($user) as $info){
            if($info->template->id==$template->id){
                return $info;
            }
        }
        return false;
    }
    
    /**
     * 
     */
    public function getUserInfo($user,$template){
        return $this->getUserWithPivot($user)->getInfoByTemplate($template);
    }

    /**
     * 
     */
    public function getViewableInfos($role=null){
        if(is_null($role)){
            return $this->trait_getViewableInfos();
        }else{
            return $this->getViewableInfosByRole($role);
        }
    }
    /**
     * 
     */
    public function getViewableInfosByRole($role){
        if(is_string($role)||is_int($role)){
            $role=$this->getRole($role);
        }
        $infos=$this->getInfos();
        $return=[];
        foreach ($infos as $info){
            if($info->viewable||$role->hasPermissionTo('group_info.'.$info->index.'.view')){
                $return[]=$info;
            }
        }
        return $return;
    }
}
