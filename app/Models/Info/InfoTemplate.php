<?php

namespace App\Models\Info;

use Illuminate\Database\Eloquent\Model;

class InfoTemplate extends Model
{
    //
    protected $guarded=["id","name"];
    //
    protected $dates = ["created_at","updated_at"];

    //
    public static function setUp(){
        foreach(config("group_system.info_templates") as $package_name=>$models){
            while(is_string($models)){
                $models=config($models);
            }
            foreach($models as $model=>$templates){
                while(is_string($templates)){
                    $templates=config($templates);
                }
                foreach($templates as $template_name=>$template){
                    self::create([
                        "name"=>$package_name."/".$template_name,
                        "model"=>$model,
                    ]);
                }
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
            return self::findByName($template,$model);
        }elseif(is_int($template)){
            return self::find($template);
        }else{
            //throw new Exception("error!!!!");
            return false;
        }
    }

    //
    public function infos(){
        return $this->hasMany('App\Models\Info\Info','info_template_id');
    }

    //
    public function model(){
        return $this->model;
    }

    //
    public function getConfigAttribute(){
        $models=config("group_system.info_templates.".$this->package_name);
        while(is_string($models)){
            $models=config($models);
        }
        $templates=$models[$this->model];
        while(is_string($templates)){
            $templates=config($templates);
        }
        $template=$templates[$this->template_name];
        while(is_string($template)){
            $template=config($template);
        }
        return $template;
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
        return $this->config["default_name"];
    }
    //
    public function getDefaultInfoAttribute(){
        return $this->config["default_info"];
    }
    //
    public function getDefaultViewableAttribute(){
        return $this->config["default_viewable"];
    }
    //
    public function getEditAttribute(){
        return $this->config["edit"];
    }
    //
    public function getDescriptionAttribute(){
        return $this->config["description"];
    }
    //
    public function getOnlyOneAttribute(){
        return $this->config["only_one"];
    }
    //
    public function getViewAttribute(){
        return $this->config["view"];
    }
    //
    public function getConstructorAttribute(){
        return isset($this->config["constructor"])?$this->config["constructor"]:null;
    }
}
