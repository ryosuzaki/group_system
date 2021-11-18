<?php

namespace App\Models\Info;

use Illuminate\Database\Eloquent\Model;

use App\Models\Info\InfoTemplate;

class InfoBase extends Model
{
    //
    protected $guarded=['id'];

    //
    protected $casts = [
        'edit'  => 'array',
    ];

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
    public function infos(){
        return $this->hasMany('App\Models\Info\Info', 'info_base_id');
    }
    //
    public function info(){
        return $this->infos()->latest()->first();
    }

    //
    public function updateInfo(array $info){
        return $this->infos()->create([
            'info'=>$info,
        ]);
    }
    //
    public function partlyUpdateInfo(array $new_info){
        $info=$this->info()->info;
        foreach($info as $key=>$value){
            if(isset($new_info[$key])){
                $info[$key]=$new_info[$key];
            }
        }
        return $this->infos()->create([
            'info'=>$info,
        ]);
    }
    //
    public function updateInfoEmptyFillDefault(array $new_info){
        $info=$this->getTemplate()->default;
        foreach($info as $key=>$value){
            if(isset($new_info[$key])){
                $info[$key]=$new_info[$key];
            }
        }
        return $this->infos()->create([
            'info'=>$info,
        ]);
    }
    //
    public function changeName(string $name){
        return $this->fill(['name'=>$name])->save();
    }
    //
    public function setEditAttribute($value){
        $this->attributes['edit'] = serialize($value);
    }
    //
    public function getEditAttribute($value){
        return unserialize($value);
    }
}
