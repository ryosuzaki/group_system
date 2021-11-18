<?php

namespace App\Traits;

use App\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Hash;

trait UseRoleInUser
{
    //
    public function modelsUsingRole($model_type){
        return $this->morphedByMany($model_type,'model','model_role_user')->withPivot('role_id');
    }
    //
    public function rolesThroughModel($model_type){
        return $this->belongsToMany(
            config('group_system.role.namespace'),'model_role_user','user_id','role_id'
        )->withPivot('model_id','model_type')->where("model_type",$model_type);
    }
    
    
    //
    public function hasModelUsingRole($model_type,int $model_id){
        return $this->modelsUsingRole($model_type)->get()->contains('id',$model_id);
    }
    //
    public function getModelUsingRole($model_type,int $model_id){
        return $this->modelsUsingRole($model_type)->find($model_id);
    }




    //
    public function joinModelRole($model_type,int $model_id,$role,string $password){
        $model=$model_type::find($model_id);
        if($model->getRole($role)->checkPassword($password)){
            return $model->inviteUser($this->id,$role);
        }
    }
    //
    public function leaveModelRole($model_type,int $model_id){
        $model=$model_type::find($model_id);
        return $model->removeUser($this->id);
    }


    //
    public function hasRoleInModel($role,$model_type,int $model_id){
        if (is_string($role)) {
            return $this->rolesThroughModel($model_type)->wherePivot('model_id',$model_id)->get()->contains('role_name',$role);
        }elseif(is_int($role)){
            return $this->rolesThroughModel($model_type)->wherePivot('model_id',$model_id)->get()->contains('id',$role);
        }
    }
    //
    public function getRoleByModel($model_type,int $model_id){
        return $this->rolesThroughModel($model_type)->wherePivot('model_id',$model_id)->first();
    }





    //
    public function modelsRequestJoin($model_type){
        return $this->morphedByMany($model_type,'model','join_requests')->withPivot('role_id');
    }

    //
    public function countModelsRequestJoin($model_type){
        return $this->modelsRequestJoin($model_type)->get()->count();
    }

    //
    public function acceptModelJoinRequest($model_type,int $model_id){
        if($this->hasModelUsingRole($model_type,$model_id)){
            $this->leaveModelRole($model_type,$model_id);
        }
        $model=$this->modelsRequestJoin($model_type)->find($model_id);
        $role_id=$model->pivot->role_id;
        $model->inviteUser($this->id,$role_id);
        return $model->usersRequestJoin()->detach($this->id);
    }
    //
    public function deniedModelJoinRequest($model_type,int $model_id){
        return $model->usersRequestJoin()->detach($this->id);
    }

}