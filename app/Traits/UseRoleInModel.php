<?php

namespace App\Traits;

use App\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Hash;

trait UseRoleInModel
{
    /**
     * 
     */
    abstract public function getPermissionsAttribute();

    /**
     * 
     */
    public function BeforeDeleteModelUsingRole(){
        foreach($this->roles()->get() as $role){
            $this->deleteRole($role->id);
        }
        return true;
    }


    /**
     * 
     */
    public function refreshRoles(){
        $permissions=$this->permissions;
        foreach ($this->roles()->get() as $role){
            $role->syncPermissions($role->getAllPermissions()->pluck('name')->intersect($permissions));
        }
        return $this->roles()->get();
    }

    //ok
    public function createRole(string $name,string $password){
        $index=$this->calcRoleIndex();
        $role=$this->roles()->create([
            'name'=>get_class($this)."/".$this->id."/".$index,
            'role_name'=>$name,
            'index'=>$index,
            'password'=>Hash::make($password),
        ]);
        return $role;
    }
    //ok
    public function deleteRole($role){
        $role=$this->getRole($role);
        $role->delete();
        return $this->refreshRoles();
    }
    //ok
    public function deleteRoleByIndex(int $index){
        $role_id=$this->getRoleByIndex($index)->id;
        return $this->deleteRole($role_id);
    }

    /**
     * 
     */
    //ok
    public function roles(){
        return $this->morphMany(config('group_system.role.namespace'),'model');
    }

    //ok
    public function getRole($role){
        if (is_string($role)) {
            return $this->roles()->where('role_name',$role)->first();
        }elseif(is_int($role)){
            return $this->roles()->find($role);
        }
    }
    //ok
    public function getRoleByIndex(int $index){
        return $this->roles()->where('index',$index)->first();
    }
    //ok
    public function getRoleByUser(int $user_id){
        return $this->getRole($this->users()->wherePivot('user_id',$user_id)->first()->pivot->role_id);
    }
    //ok
    public function usersHaveRole($role){
        $role=$this->getRole($role);
        return $this->users()->wherePivot('role_id',$role->id);
    }
    //ok
    public function getUsersHaveRole($role){
        $role=$this->getRole($role);
        return $this->users()->wherePivot('role_id',$role->id)->get();
    }
    //
    private function calcRoleIndex(){
        $indexes=$this->roles()->pluck('index');
        $diff=collect(range(0,config("group_system.role.max_num_of_roles")-1))->diff($indexes);
        if($diff->isNotEmpty()){
            return $diff->min();
        }
    }

    //ok
    public function users(){
        return $this->morphToMany('App\User','model','model_role_user')->withPivot('role_id');
    }
    
    //ok
    public function inviteUser(int $user_id,$role){
        $user=User::find($user_id);
        $role_id=$this->getRole($role)->id;
        if ($user->hasModelUsingRole(self::class,$this->id)) {
            $this->removeUser($user_id);
        }
        $user->assignRole($role_id);
        return $this->users()->attach($user_id,['role_id'=>$role_id]);
    }
    //ok
    public function removeUser(int $user_id){
        $user=$this->getUser($user_id);
        $role_id=$user->pivot->role_id;
        $user->removeRole($role_id);
        return $this->users()->detach($user_id);
    }

    

    //ok
    public function hasUser(int $id){
        return $this->users()->get()->contains('id',$id);
    }
    //ok
    public function hasUserInRole(int $user_id,$role){
        if (is_string($role)) {
            return $this->users()->wherePivot('role_id',$this->getRole($role)->id)->get()->contains('id',$user_id);
        }elseif(is_int($role)){
            return $this->users()->wherePivot('role_id',$role)->get()->contains('id',$user_id);
        }
    }
    //ok
    public function getUser(int $id){
        return $this->users()->find($id);
    }

    /**
     * 
     */
    //ok
    public function usersRequestJoin(){
        return $this->morphToMany(config('auth.providers.users.model'),'model','join_requests')->withPivot('role_id');
    }
    public function getUsersRequestJoin(){
        return $this->usersRequestJoin()->get();
    }

    //ok
    public function hasUserJoinRequest(int $user_id){
        return $this->usersRequestJoin()->wherePivot('user_id',$user_id)->get()->isNotEmpty();
    }
    //ok
    public function requestJoin(int $user_id,$role){
        if($this->hasUserJoinRequest($user_id)){
            $this->usersRequestJoin()->detach($user_id);
        }
        $role=$this->getRole($role);
        return $this->usersRequestJoin()->attach($user_id,['role_id'=>$role->id]);
    }
    //ok
    public function quitRequestJoin(int $user_id){
        return $this->usersRequestJoin()->detach($user_id);
    }

}