<?php

namespace App\Models\Info;

use Illuminate\Database\Eloquent\Model;

class InfoTemplate extends Model
{
    //
    protected $guarded=["id","name"];

    //
    public static function setUp(){
        foreach(config("group_system.info_templates") as $package_name=>$templates){
            foreach($templates as $template_name=>$template){
                self::create([
                    "name"=>$package_name."/".$template_name,
                    "model"=>$template["model"],
                ]);
            }
        }
    }
    //
    public static function findByName(string $name,$model){
        return self::getByModel($model)->where('name',$name)->first();
    }
    //
    public static function getByModel($model){
        return self::where('model',get_class($model))->get();
    }
    //
    public static function findByIdOrName($template,$model=null){
        if (is_string($template)&&$model!=null) {
            return self::findByName($template,get_class($model));
        }elseif(is_int($template)){
            return self::find($template);
        }else{
            throw new Exception("error!!!!");
        }
    }

    //
    public function infoBases(){
        return $this->hasMany('App\Models\Info\InfoBase','info_template_id');
    }

    //
    public function model(){
        return $this->model;
    }

    //
    public function getPackageNameAttribute(){
        $name=explode('/', $this->name);
        return $name[0];
    }
    //
    public function getTemplateNameAttribute(){
        $name=explode('/', $this->name);
        return $name[1];
    }
    //
    public function getDefaultNameAttribute(){
        return config("group_system.info_templates.".$this->package_name.".".$this->template_name.".default_name");
    }
    //
    public function getDefaultInfoAttribute(){
        return config("group_system.info_templates.".$this->package_name.".".$this->template_name.".default_info");
    }
    //
    public function getDefaultEditAttribute(){
        return config("group_system.info_templates.".$this->package_name.".".$this->template_name.".default_edit");
    }
    //
    public function getDefaultViewableAttribute(){
        return config("group_system.info_templates.".$this->package_name.".".$this->template_name.".default_viewable");
    }
    //
    public function getDescriptionAttribute(){
        return config("group_system.info_templates.".$this->package_name.".".$this->template_name.".description");
    }
    //
    public function getOnlyOneAttribute(){
        return config("group_system.info_templates.".$this->package_name.".".$this->template_name.".only_one");
    }
}
