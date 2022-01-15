<?php

namespace App\Models\Info;

use Illuminate\Database\Eloquent\Model;

use App\Models\Info\InfoTemplate;

use Wildside\Userstamps\Userstamps;

class Info extends Model
{
    //
    protected $guarded=['id'];
    //
    protected $casts = [
        'viewable' => 'boolean',
        'viewable_to_models'  => 'collection',
        'info'  => 'array',
    ];
    //
    protected $dates = ["created_at","updated_at"];
    //
    protected $with = ['template'];

    //
    public function model(){
        return $this->morphTo();
    }
    //
    public function template(){
        return $this->belongsTo(InfoTemplate::class,'info_template_id');
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
        $info=$this->template->default_info;
        foreach($info as $key=>$value){
            if(isset($new_info[$key])){
                $info[$key]=$new_info[$key];
            }
        }
        return $this->updateInfo($info);
    }
    //
    public function setName(string $name){
        return $this->fill([
            'name'=>$name,
            ])->save();
    }

    //
    public function setViewable(bool $viewable){
        return $this->fill([
            'viewable'=>$viewable,
        ])->save();
    }

    //
    public function setViewableToModel(bool $viewable,$model){
        $this->viewable_to_models=$this->viewable_to_models->put($this->viewableToModelKeyName($model),$viewable);
        return $this->save();
    }

    //
    private function viewableToModelKeyName($model){
        return  get_class($model)."/".$model->id;
    }

    //
    public function isViewableToModel($model){
        if($this->viewable){
            return true;
        }
        $viewable=$this->viewable_to_models->get($this->viewableToModelKeyName($model));
        return isset($viewable)?$viewable:false;
    }

    //
    public function getTemplateConfig(){
        return $this->template->config;
    }
    //
    public function getEditAttribute(){
        return $this->template->edit;
    }
}
