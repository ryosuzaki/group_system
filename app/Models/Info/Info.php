<?php

namespace App\Models\Info;

use Illuminate\Database\Eloquent\Model;

use Wildside\Userstamps\Userstamps;

class Info extends Model
{
    //
    protected $guarded=['id'];
    //
    protected $casts = [
        'info'  => 'array',
    ];
    //
    protected $dates = ["created_at","updated_at"];

    //
    public function setInfoAttribute($value){
        $this->attributes['info'] = serialize($value);
    }
    //
    public function getInfoAttribute($value){
        return unserialize($value);
    }


    //
    public function model(){
        return $this->morphTo();
    }
    //
    public function infoTemplate(){
        return $this->belongsTo('App\Models\Info\InfoTemplate','info_template_id');
    }
    //
    public function getTemplate(){
        return $this->infoTemplate()->first();
    }
    
    //
    public function updateInfo(array $info){
        return $this->fill([
            'info'=>$info,
        ])->save();
    }
    //
    public function partlyUpdateInfo(array $new_info){
        $info=$this->info;
        foreach($info as $key=>$value){
            if(isset($new_info[$key])){
                $info[$key]=$new_info[$key];
            }
        }
        return $this->updateInfo($info);
    }
    //
    public function updateInfoEmptyFillDefault(array $new_info){
        $info=$this->getTemplate()->default_info;
        foreach($info as $key=>$value){
            if(isset($new_info[$key])){
                $info[$key]=$new_info[$key];
            }
        }
        return $this->updateInfo($info);
    }
    //
    public function changeName(string $name){
        return $this->fill(['name'=>$name])->save();
    }

    //
    public function setViewable(bool $viewable){
        return $this->fill([
            
        ])->save();
    }

    //
    public function getTemplateConfig(){
        return $this->getTemplate()->config;
    }
    //
    public function getEditAttribute(){
        return $this->getTemplate()->edit;
    }
    





}
