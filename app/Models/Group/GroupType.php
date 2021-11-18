<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupType extends Model
{
    //
    protected $guarded = ['id','name'];
    
    //
    public static function findByName($name){
        return parent::where('name',$name)->first();
    }
    //
    public static function findByIdOrName($type){
        if (is_string($type)) {
            return self::findByName($type);
        }elseif(is_int($type)){
            return self::find($type);
        }
    }


    //
    public function groups(){
        return $this->hasMany('App\Models\Group\Group','group_type_id');
    }
    

    //
    public function getName(){
        return config("group_system.types.".$this->name.".name");
    }
    //
    public function getInitialInfoAttribute(){
        return config("group_system.types.".$this->name.".initial_info");
    }
    //
    public function getAvailableUserInfoAttribute(){
        return config("group_system.types.".$this->name.".available_user_info");
    }
}
