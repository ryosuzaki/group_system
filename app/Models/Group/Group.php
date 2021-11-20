<?php

namespace App\Models\Group;
use Illuminate\Database\Eloquent\Model;

use App\Models\Info\InfoBase;

use App\User;

use App\Models\Group\GroupType;

use App\Traits\UseInfo;
use App\Traits\UseRoleInModel;

use App\Traits\UploadImg;
use App\Traits\SendAnnouncement;
use App\Traits\UseLocation;

use App\Models\Upload\Image;
use Illuminate\Http\UploadedFile;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class Group extends Model
{
    use UseInfo;
    use UseRoleInModel;
    use UploadImg{
        uploadImg::uploadImg as trait_uploadImg;
    }
    use SendAnnouncement;
    use UseLocation;

    //
    protected $guarded = ['id'];
    

    /**
     * 
     */
    public function getPermissionsAttribute(){
        $permission_config=config("group_system.group_types.".$this->getTypeName().".permission");
        //
        $permissions=[];
        $permissions[]='group.*';
        foreach(config('group_system.role.group') as $action){
            $permissions[]='group.'.$action;
        }
        //
        if($permission_config["group_info_bases"]){
            $permissions[]='group_info_bases.*';
            foreach(config('group_system.role.group_info_bases') as $action){
                $permissions[]='group_info_bases.'.$action;
            }
        }
        //
        $permissions[]='group_info.*';
        foreach($this->infoBases()->get() as $base){
            $permissions[]='group_info.'.$base->index.'.*';
            foreach(config('group_system.role.group_info') as $action){
                $permissions[]='group_info.'.$base->index.'.'.$action;
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
            $group->createInfoBase($template);
        }
        //
        $admin_config=config('group_system.group_types.'.$type->name.'.admin');
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


    //
    //functions of GroupType
    //
    //
    public function type(){
        return $this->belongsTo('App\Models\Group\GroupType','group_type_id');
    }
    //
    public function getType(){
        return $this->type()->first();
    }
    //
    public function getTypeName(){
        return $this->getType()->name;
    }


    /**
     * 
     */
    public function getUserInfoBases(int $user_id){
        return $this->getUser($user_id)->infoBases()->whereIn('info_template_id',$this->getType()->available_user_info)->get();
    }
    public function getUserInfoBase(int $user_id,int $template_id){
        if(collect($this->getType()->available_user_info)->contain($template_id)){
            return $this->getUser($user_id)->getInfoBaseByTemplate($template_id);
        }
    }

    /**
     * 
     */
    public function getViewableInfoBases($role=null){
        if(is_null($role)){
            return $this->infoBases()->where('viewable',true)->get();
        }else{
            $role=$this->getRole($role);
            $viewable_bases=[];
            foreach ($this->infoBases()->get() as $base){
                if($base->viewable||$role->hasPermissionTo('group_info.'.$base->index.'.view')){
                    $viewable_bases[]=$base;
                }
            }
            return $viewable_bases;
        }
    }
    public function getViewableInfoBasesByRole($role){
        $role=$this->getRole($role);
        $bases=$this->infoBases()->get();
        $return=[];
        foreach ($bases as $base){
            if($base->viewable||$role->hasPermissionTo('group_info.'.$base->index.'.view')){
                $return[]=$base;
            }
        }
        return $return;
    }

    /**
     * 
     */
    public function uploadImg(UploadedFile $img){
        return $this->trait_uploadImg($img,$this->unique_name);
    }
    
    



    //
    //functions of extra user
    //
    //
    public function extraUsers(string $name=null){
        if($name == null){
            return $this->belongsToMany(
                config('auth.providers.users.model'),'extra_group_users','group_id','user_id'
            )->withPivot('name');
        }else{
            return $this->belongsToMany(
                config('auth.providers.users.model'),'extra_group_users','group_id','user_id'
            )->withPivot('name')->wherePivot('name',$name);
        }
    }
    //
    public function countExtraUsers(string $name){
        return $this->extraUsers()->wherePivot('name',$name)->get()->count();
    }


    



   
    

    
}
