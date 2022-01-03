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
        $roles=$this->roles()->get();
        foreach ($roles as $role){
            $role->syncPermissions($role->getAllPermissions()->pluck('name')->intersect($permissions));
        }
        return $roles;
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
        }elseif(is_a($role,Role::class)){
            return $role;
        }
    }
    //ok
    public function getRoleByIndex(int $index){
        return $this->roles()->where('index',$index)->first();
    }
    //ok
    public function getRoleByUser($user){
        return $this->getRole($this->getUserWithPivot($user)->pivot->role_id);
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
    //
    public function checkRolePassword($role,string $password){
        return $this->getRole($role)->checkPassword($password);
    }

    //ok
    public function users(){
        return $this->morphToMany(User::class,'model','model_role_user')->withPivot('role_id');
    }
    
    //ok
    public function inviteUser($user,$role){
        if(is_int($user)){
            $user=User::find($user);
        }
        $role=$this->getRole($role);
        if ($user->hasModelUsingRole(self::class,$this->id)) {
            $this->removeUser($user->id);
        }
        $user->assignRole($role->id);
        return $this->users()->attach($user->id,['role_id'=>$role->id]);
    }
    //ok
    public function removeUser($user){
        $user=$this->getUserWithPivot($user);
        $role_id=$user->pivot->role_id;
        $user->removeRole($role_id);
        return $this->users()->detach($user->id);
    }

    

    //ok
    public function hasUserInRoles($user){
        if(is_int($user)){
            return $this->users()->get()->contains('id',$user);
        }else{
            return $this->users()->get()->contains('id',$user->id);
        }
    }
    //ok
    public function hasUserInRole($user,$role){
        return $this->getUserWithPivot($user)->pivot->role_id==$this->getRole($role)->id;
    }
    //ok
    public function getUserWithPivot($user){
        if(is_int($user)){
            return $this->users()->find($user);
        }else{
            return $this->users()->find($user->id);
        }
    }

    /**
     * 
     */
    //ok
    public function usersRequestJoin(){
        return $this->morphToMany(config('auth.providers.users.model'),'model','join_requests')->withPivot('role_id');
    }
    //
    public function getUsersRequestJoin(){
        return $this->usersRequestJoin()->get();
    }
    //
    public function getUsersRequestJoinInRole($role){
        $role=$this->getRole($role);
        return $this->usersRequestJoin()->wherePivot('role_id',$role->id)->get();
    }
    //ok
    public function getUserRequestJoin($user){
        if(is_int($user)){
            return $this->usersRequestJoin()->find($user);
        }else{
            return $this->usersRequestJoin()->find($user->id);
        }
    }

    //ok
    public function hasUserRequestJoin($user){
        return is_null($this->getUserRequestJoin($user))?false:true;
    }
    //ok
    public function requestJoin($user,$role){
        if($this->hasUserRequestJoin($user)){
            if(is_int($user)){
                $this->usersRequestJoin()->detach($user);
            }else{
                $this->usersRequestJoin()->detach($user->id);
            }
        }
        $role=$this->getRole($role);
        if(is_int($user)){
            return $this->usersRequestJoin()->attach($user,['role_id'=>$role->id]);
        }else{
            return $this->usersRequestJoin()->attach($user->id,['role_id'=>$role->id]);
        }
    }
    //ok
    public function quitRequestJoin($user){
        if(is_int($user)){
            return $this->usersRequestJoin()->detach($user);
        }else{
            return $this->usersRequestJoin()->detach($user->id);
        }
    }

}