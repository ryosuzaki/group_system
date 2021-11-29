<?php

namespace App\Models\Group;

use Illuminate\Database\Eloquent\Model;

class GroupType extends Model
{
    //
    protected $guarded = ['id','name'];

    public static function setUp(){
        foreach(config("group_system.group_types") as $type=>$body){
            self::create([
                'name'=>$type,
            ]);
        }
    }
    
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
    public function getConfigAttribute(){
        $type=config("group_system.group_types.".$this->name);
        while(is_string($type)){
            $type_path=$type;
            $type=config($type);
        }
        return $type;
    }
    //
    public function getName(){
        return $this->config["name"];
    }
    //
    public function getInitialInfoAttribute(){
        return $this->config["initial_info"];
    }
    //
    public function getAvailableUserInfoAttribute(){
        return $this->config["available_user_info"];
    }
    //
    public function getViewAttribute(){
        return $this->config["view"];
    }
    //
    public function getAvailableIndexViewAttribute(){
        return $this->config["available_index_view"];
    }
    //
    public function getAvailableCreateViewAttribute(){
        return $this->config["available_create_view"];
    }
    //
    public function getAdminAttribute(){
        return $this->config["admin"];
    }
    //
    public function getPermissionAttribute(){
        return $this->config["permission"];
    }
}
